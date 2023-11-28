<?php

namespace danplaton4\BeesInTheTrap;

use danplaton4\BeesInTheTrap\Hive\Hive;
use danplaton4\BeesInTheTrap\Player\PlayerFactory;
use danplaton4\BeesInTheTrap\Service\HiveService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GameCommand extends Command
{

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setName('game:start')
            ->setDescription('Starts the Bees in the Trap game');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->note('Welcome to the Bees in the Trap!');

        $playerName = $this->getPlayerName($io);
        $gameMode = $this->getGameMode($io);
        $game = $this->initializeGame($io, $playerName);

        $io->note('Starting the game ...');
        sleep(1);

        while ($game->isGameOver() === false) {
            $io->warning('==== New Turn ====');

            $io->note($playerName . ' Life = ' . $game->getPlayer()->getHitPoints() . ' | ' .
                $playerName . ' Damage = ' . $game->getPlayerHits() . ' | ' .
                'Hive Damage = ' . $game->getBeesHits()
            );

            sleep(1);

            match ($gameMode) {
                'auto' => $this->playAuto($io, $game),
                default => $this->playManual($io, $game)
            };
        }

        return Command::SUCCESS;
    }

    /**
     * @param SymfonyStyle $io
     * @return string
     */
    private function getPlayerName(SymfonyStyle $io): string
    {
        $playerName = $io->ask('What is your name?');
        $io->info("Welcome to the game, $playerName");

        return $playerName;
    }

    /**
     * @param SymfonyStyle $io
     * @return string
     */
    private function getGameMode(SymfonyStyle $io): string
    {
        $choice = $io->choice(
            'Pick up the game mode',
            ['auto' => 'automatic mode', 'manual' => 'manual mode'],
            'manual'
        );
        $io->info("Great! You chose the $choice game mode");

        return $choice;
    }

    /**
     * @param SymfonyStyle $io
     * @param string $playerName
     * @return Game
     */
    private function initializeGame(SymfonyStyle $io, string $playerName): Game
    {
        $io->note('Preparing game objects! Please wait...');

        $progressBar = $io->createProgressBar(3);

        $progressBar->setProgress(1);
        sleep(1);
        $player = PlayerFactory::createHumanPlayer($playerName);
        $io->note('Player is ready!');

        $progressBar->setProgress(2);
        sleep(1);
        $hive = new Hive();
        $hiveService = new HiveService($hive);
        $io->note('Hive is ready!');

        $progressBar->setProgress(3);
        sleep(1);
        $game = new Game($hive, $player, $hiveService);
        $io->note('Game is ready!');

        return $game;
    }

    /**
     * @param SymfonyStyle $io
     * @param Game $game
     * @return void
     */
    private function playManual(SymfonyStyle $io, Game $game): void
    {
        $playerName = $game->getPlayer()->getName();
        $playerTurn = $io->ask("Is your turn, $playerName! Hit the hive!", 'hit');

        if ($playerTurn === 'hit') {
            $game->playTurn($io);
        } else {
            $io->ask('Don\'t you want to hit the hive?', 'hit');
        }
    }

    /**
     * @param SymfonyStyle $io
     * @param Game $game
     * @return void
     */
    private function playAuto(SymfonyStyle $io, Game $game): void
    {
        $game->playTurn($io);
    }
}

<?php

namespace danplaton4\BeesInTheTrap;

use danplaton4\BeesInTheTrap\Hive\Bee\DroneBee;
use danplaton4\BeesInTheTrap\Hive\Bee\QueenBee;
use danplaton4\BeesInTheTrap\Hive\Bee\WorkerBee;
use danplaton4\BeesInTheTrap\Hive\Hive;
use danplaton4\BeesInTheTrap\Player\Player;
use danplaton4\BeesInTheTrap\Service\HiveService;
use Symfony\Component\Console\Style\SymfonyStyle;

class Game
{
    private Hive $hive;
    private Player $player;
    private HiveService $hiveService;
    private bool $gameOver = false;
    private int $playerHits = 0;
    private int $beesHits = 0;

    public function __construct(Hive $hive, Player $player, HiveService $hiveService)
    {
        $this->hive = $hive;
        $this->player = $player;
        $this->hiveService = $hiveService;

        // Initialize bees
        $this->initializeBees();
    }

    /**
     * @return void
     */
    private function initializeBees(): void
    {
        // Add queens to hive
        for ($i = 0; $i < GameConfiguration::QUEEN_BEE_POPULATION; $i++) {
            $this->hive->addBee(new QueenBee(
                GameConfiguration::QUEEN_BEE_HP,
                GameConfiguration::QUEEN_BEE_DAMAGE_HIT,
                GameConfiguration::QUEEN_BEE_STING_HIT
            ));
        }

        // Add workers to hive
        for ($i = 0; $i < GameConfiguration::WORKER_BEE_POPULATION; $i++) {
            $this->hive->addBee(new WorkerBee(
                GameConfiguration::WORKER_BEE_HP,
                GameConfiguration::WORKER_BEE_DAMAGE_HIT,
                GameConfiguration::WORKER_BEE_STING_HIT
            ));
        }

        // Add drones to hive
        for ($i = 0; $i < GameConfiguration::DRONE_BEE_POPULATION; $i++) {
            $this->hive->addBee(new DroneBee(
                GameConfiguration::DRONE_BEE_HP,
                GameConfiguration::DRONE_BEE_DAMAGE_HIT,
                GameConfiguration::DRONE_BEE_STING_HIT
            ));
        }
    }

    /**
     * @param SymfonyStyle $io
     * @return void
     */
    public function playTurn(SymfonyStyle $io): void
    {
        // Player's turn
        $this->playerTurn($io);
        sleep(1);

        // Check if the game is over
        $this->checkGameOver($io);

        // Bees' turn
        $this->beesTurn($io);
        sleep(1);

        // Check if the game is over
        $this->checkGameOver($io);
    }

    /**
     * @param SymfonyStyle $io
     * @return void
     */
    private function playerTurn(SymfonyStyle $io): void
    {
        if ($this->gameOver) {
            return;
        }

        // Get the missing chances
        if ($this->hasMissed()) {
            $io->error('Miss! You just missed the hive, better luck next time!');
            return;
        }

        // Select a random bee
        $bee = $this->hiveService->getRandomBee();

        // Get the bee type
        $beeType = ucfirst($this->hiveService->getBeeType($bee));


        $io->info($beeType . ' = ' . $bee->getHitPoints());

        // Damage that bee based on the damage hit
        $damagePoints = $bee->getDamagePoints();
        $bee->takeDamage($bee->getDamagePoints());

        $io->success("Direct Hit! You took $damagePoints hit points from a $beeType bee");
        $this->playerHits++;
    }

    /**
     * @return bool|null
     */
    private function hasMissed(): ?bool
    {
        return round(rand() / (getrandmax() + 1), 2) <= GameConfiguration::MISS_CHANCES;
    }

    /**
     * @param SymfonyStyle $io
     * @return void
     */
    private function checkGameOver(SymfonyStyle $io): void
    {
        if ($this->hiveService->isQueenDead()) {
            $message = 'Congratulations! You killed the queen! It took ' . $this->playerHits . ' hits to kill it';
        } elseif ($this->player->getHitPoints() <= 0) {
            $message = 'Game over! You were stung to death by bees. It took ' . $this->beesHits . ' stings.';
        } elseif ($this->hiveService->areAllBeesDead()) {
            $message = 'Congratulations! You destroyed the hive. It took ' . $this->playerHits . ' hits to kill bees';
        } else {
            return; // Game is not over
        }

        $io->warning($message);
        $this->gameOver = true;
    }

    /**
     * @param SymfonyStyle $io
     * @return void
     */
    private function beesTurn(SymfonyStyle $io): void
    {
        if ($this->gameOver) {
            return;
        }

        // Get the missing chances
        if ($this->hasMissed()) {
            $io->success('Buzz! That was close! The Bee just missed you!');
            return;
        }

        // Select a random bee
        $bee = $this->hiveService->getRandomBee();

        // Get the bee type
        $beeType = ucfirst($this->hiveService->getBeeType($bee));

        $stingDamage = $bee->getStingDamage();
        $this->player->takeDamage($stingDamage);

        $io->error("Sting! You just got stung by $beeType bee with $stingDamage hit points");
        $this->beesHits++;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @return bool
     */
    public function isGameOver(): bool
    {
        return $this->gameOver;
    }

    /**
     * @return int
     */
    public function getPlayerHits(): int
    {
        return $this->playerHits;
    }

    /**
     * @return int
     */
    public function getBeesHits(): int
    {
        return $this->beesHits;
    }
}

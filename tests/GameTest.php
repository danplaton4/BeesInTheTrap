<?php

use danplaton4\BeesInTheTrap\Game;
use danplaton4\BeesInTheTrap\Hive\Bee\Bee;
use danplaton4\BeesInTheTrap\Hive\Hive;
use danplaton4\BeesInTheTrap\Player\Player;
use danplaton4\BeesInTheTrap\Service\HiveService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Style\SymfonyStyle;

class GameTest extends TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testPlayerTurnHitsAnyBee()
    {
        // Create necessary dependencies
        $hive = $this->getMockBuilder(Hive::class)
            ->getMock();
        $hive->expects($this->any())->method('addBee')->with($this->isInstanceOf(Bee::class));

        $player = $this->getMockBuilder(Player::class)
            ->setConstructorArgs([100])
            ->getMock();
        $player->method('getHitPoints')->willReturn(100);
        $player->expects($this->once())->method('takeDamage')->with(10);

        $hiveService = new HiveService($hive);

        // Mock SymfonyStyle
        $io = $this->getMockBuilder(SymfonyStyle::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Create Game instance
        $game = new Game($hive, $player, $hiveService);

        // Run the player turn
        $game->playTurn($io);

        // Assert the expected behavior
        $this->assertTrue($game->getPlayerHits() > 0); // Adjust the condition based on your logic
        $this->assertTrue($game->isGameOver()); // Assuming hitting any bee ends the game
    }
}


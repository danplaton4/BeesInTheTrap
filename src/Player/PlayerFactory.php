<?php

namespace danplaton4\BeesInTheTrap\Player;

class PlayerFactory
{
    /**
     * @param string $name
     * @return Player
     */
    public static function createHumanPlayer(string $name): Player
    {
        $player = new Player(100);
        $player->setName($name);

        return $player;
    }

    // Other types of players

    /**
     * @return Player
     */
    public static function createAIPlayer(): Player
    {
        $player = new Player(150);
        $player->setName('Computer');

        return $player;
    }
}

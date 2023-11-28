<?php

namespace danplaton4\BeesInTheTrap\Behaviour\Stinging;

use danplaton4\BeesInTheTrap\Player\Player;

interface StingingBehaviour
{
    /**
     * @return int
     */
    public function getStingDamage(): int;

    /**
     * @param Player $player
     * @return void
     */
    public function stingPlayer(Player $player): void;
}

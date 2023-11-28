<?php

namespace danplaton4\BeesInTheTrap\Behaviour\Stinging;

use danplaton4\BeesInTheTrap\Player\Player;

trait StingTrait
{
    protected int $stingDamage;

    /**
     * @return int
     */
    public function getStingDamage(): int
    {
        return $this->stingDamage;
    }

    /**
     * @param Player $player
     * @return void
     */
    public function stingPlayer(Player $player): void
    {
        $player->takeDamage($this->stingDamage);
    }
}

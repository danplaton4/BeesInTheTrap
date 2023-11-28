<?php

namespace danplaton4\BeesInTheTrap\Behaviour\Damageable;

trait DamageableTrait
{
    protected int $damagePoints;

    /**
     * @return int
     */
    public function getDamagePoints(): int
    {
        return $this->damagePoints;
    }

    /**
     * @return bool
     */
    public function isDead(): bool
    {
        return $this->hitPoints <= 0;
    }
}

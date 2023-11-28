<?php

namespace danplaton4\BeesInTheTrap\Behaviour\Damageable;

interface DamageableBehaviour
{
    /**
     * @return int
     */
    public function getDamagePoints(): int;

    /**
     * @return bool
     */
    public function isDead(): bool;
}

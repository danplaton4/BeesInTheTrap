<?php

namespace danplaton4\BeesInTheTrap\Behaviour\Damageable;

interface TakeDamageBehaviour
{
    /**
     * @param int $damage
     * @return void
     */
    public function takeDamage(int $damage): void;
}

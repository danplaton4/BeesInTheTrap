<?php

namespace danplaton4\BeesInTheTrap\Behaviour\Damageable;

trait TakeDamageTrait
{
    /**
     * @param int $damage
     * @return void
     */
    public function takeDamage(int $damage): void
    {
        $this->hitPoints -= $damage;

        if ($this->hitPoints < 0) {
            $this->hitPoints = 0;
        }
    }
}

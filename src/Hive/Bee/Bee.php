<?php

namespace danplaton4\BeesInTheTrap\Hive\Bee;

use danplaton4\BeesInTheTrap\Behaviour\Damageable\DamageableBehaviour;
use danplaton4\BeesInTheTrap\Behaviour\Damageable\DamageableTrait;
use danplaton4\BeesInTheTrap\Behaviour\Damageable\TakeDamageBehaviour;
use danplaton4\BeesInTheTrap\Behaviour\Damageable\TakeDamageTrait;
use danplaton4\BeesInTheTrap\Behaviour\Lifespan\LifespanBehaviour;
use danplaton4\BeesInTheTrap\Behaviour\Lifespan\LifespanTrait;

abstract class Bee implements DamageableBehaviour, LifespanBehaviour, TakeDamageBehaviour
{
    use DamageableTrait, LifespanTrait, TakeDamageTrait;

    /**
     * @param int $hitPoints
     * @param int $damagePoints
     */
    public function __construct(int $hitPoints, int $damagePoints)
    {
        $this->hitPoints = $hitPoints;
        $this->damagePoints = $damagePoints;
    }
}

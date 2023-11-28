<?php

namespace danplaton4\BeesInTheTrap\Hive\Bee;

use danplaton4\BeesInTheTrap\Behaviour\Stinging\StingingBehaviour;
use danplaton4\BeesInTheTrap\Behaviour\Stinging\StingTrait;

class DroneBee extends Bee implements StingingBehaviour
{
    use StingTrait;

    /**
     * @param int $hitPoints
     * @param int $damagePoints
     * @param int $stingDamage
     */
    public function __construct(int $hitPoints, int $damagePoints, int $stingDamage)
    {
        $this->stingDamage = $stingDamage;

        parent::__construct($hitPoints, $damagePoints);
    }
}

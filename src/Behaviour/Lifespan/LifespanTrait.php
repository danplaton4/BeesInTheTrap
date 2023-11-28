<?php

namespace danplaton4\BeesInTheTrap\Behaviour\Lifespan;

trait LifespanTrait
{
    protected int $hitPoints;

    /**
     * @return int
     */
    public function getHitPoints(): int
    {
        return $this->hitPoints;
    }
}

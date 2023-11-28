<?php

namespace danplaton4\BeesInTheTrap\Hive;

use danplaton4\BeesInTheTrap\Hive\Bee\Bee;

class Hive
{
    private array $bees = [];

    public function getBees(): array
    {
        return $this->bees;
    }

    public function addBee(Bee $bee): void
    {
        $this->bees[] = $bee;
    }
}

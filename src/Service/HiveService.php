<?php

namespace danplaton4\BeesInTheTrap\Service;

use danplaton4\BeesInTheTrap\Hive\Bee\Bee;
use danplaton4\BeesInTheTrap\Hive\Bee\DroneBee;
use danplaton4\BeesInTheTrap\Hive\Bee\QueenBee;
use danplaton4\BeesInTheTrap\Hive\Bee\WorkerBee;
use danplaton4\BeesInTheTrap\Hive\Hive;
use RuntimeException;

class HiveService
{
    public Hive $hive;

    /**
     * @param Hive $hive
     */
    public function __construct(Hive $hive)
    {
        $this->hive = $hive;
    }

    /**
     * @return bool
     */
    public function isQueenDead(): bool
    {
        foreach ($this->hive->getBees() as $bee) {
            return $bee instanceof QueenBee && $bee->isDead();
        }

        return false;
    }

    /**
     * Get a random living bee based on a weighted probability of hit points.
     *
     * This method selects a living bee randomly, considering the remaining hit points of each bee as a weight.
     * The probability of selecting a bee is proportional to its remaining hit points, ensuring statistical correctness.
     * @return QueenBee|WorkerBee|DroneBee A random living bee, or null if there are no living bees.
     */
    public function getRandomBee(): QueenBee|WorkerBee|DroneBee
    {
        // Filter out dead bees
        $aliveBees = array_filter($this->hive->getBees(), function ($bee) {
            return $bee->getHitPoints() > 0;
        });

        // If there are no living bees, return null
        if (empty($aliveBees)) {
            throw new RuntimeException('No living bees available.');
        }

        // Calculate total weight based on hit points
        $totalWeight = 0;
        foreach ($aliveBees as $bee) {
            $totalWeight += $bee->getHitPoints();
        }

        // Select a random weight within the total weight
        $randomWeight = rand(1, $totalWeight);

        // Iterate through bees and select the one based on weights
        foreach ($aliveBees as $bee) {
            $randomWeight -= $bee->getHitPoints();
            if ($randomWeight <= 0) {
                return $bee;
            }
        }

        // This should not happen under normal circumstances
        throw new RuntimeException('Failed to select a random living bee.');
    }

    /**
     * @param Bee $bee
     * @return string
     */
    public function getBeeType(Bee $bee): string
    {
        return match ($bee::class) {
            QueenBee::class => 'queen',
            WorkerBee::class => 'worker',
            DroneBee::class => 'drone'
        };
    }

    /**
     * Check if all bees in the hive are dead.
     *
     * @return bool True if all bees are dead, false otherwise.
     */
    public function areAllBeesDead(): bool
    {
        foreach ($this->hive->getBees() as $bee) {
            if ($bee->getHitPoints() > 0) {
                return false; // At least one bee is still alive
            }
        }

        return true; // All bees are dead
    }
}

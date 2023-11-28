<?php

namespace danplaton4\BeesInTheTrap;

class GameConfiguration
{
    // Queen Bee configuration
    public const QUEEN_BEE_HP = 100;
    public const QUEEN_BEE_DAMAGE_HIT = 10;
    public const QUEEN_BEE_STING_HIT = 10;
    public const QUEEN_BEE_POPULATION = 1;

    // Worker Bee Configuration
    public const WORKER_BEE_HP = 75;
    public const WORKER_BEE_DAMAGE_HIT = 25;
    public const WORKER_BEE_STING_HIT = 5;
    public const WORKER_BEE_POPULATION = 5;

    // Drone Bee Configuration
    public const DRONE_BEE_HP = 60;
    public const DRONE_BEE_DAMAGE_HIT = 30;
    public const DRONE_BEE_STING_HIT = 1;
    public const DRONE_BEE_POPULATION = 25;

    // Game config
    public const MISS_CHANCES = 0.2; // 20% miss chance
}

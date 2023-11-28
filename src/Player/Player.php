<?php

namespace danplaton4\BeesInTheTrap\Player;

use danplaton4\BeesInTheTrap\Behaviour\Damageable\TakeDamageBehaviour;
use danplaton4\BeesInTheTrap\Behaviour\Damageable\TakeDamageTrait;
use danplaton4\BeesInTheTrap\Behaviour\Lifespan\LifespanBehaviour;
use danplaton4\BeesInTheTrap\Behaviour\Lifespan\LifespanTrait;

class Player implements LifespanBehaviour, TakeDamageBehaviour
{
    use LifespanTrait, TakeDamageTrait;

    public function __construct(int $hitPoints)
    {
        $this->hitPoints = $hitPoints;
    }

    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function takeDamage(int $damage): void
    {
        $this->hitPoints -= $damage;

        if ($this->hitPoints < 0) {
            $this->hitPoints = 0;
        }
    }
}

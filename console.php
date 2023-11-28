<?php

require __DIR__.'/vendor/autoload.php';

use danplaton4\BeesInTheTrap\GameCommand;
use Symfony\Component\Console\Application;

// Register your command
$application = new Application();
$application->add(new GameCommand());

// Run the application
$application->run();
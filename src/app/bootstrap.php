<?php

setlocale(LC_ALL, null);

/**
 * My Application bootstrap file.
 */
use Nette\Application\Routers\Route;


// Load Nette Framework or autoloader generated by Composer
require LIBS_DIR . '/autoload.php';


// Configure application
$configurator = new Nette\Config\Configurator;

// Enable Nette Debugger for error visualisation & logging
//$configurator->setDebugMode($configurator::AUTO);
$configurator->enableDebugger(__DIR__ . '/../log');

// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
	->addDirectory(APP_DIR)
	->addDirectory(LIBS_DIR)
	->register();

// Create Dependency Injection container from config.neon file
$configurator->addConfig(__DIR__ . '/config/config.neon');
$container = $configurator->createContainer();

// Setup router
$container->router[] = new Route('', array(
    'presenter' => 'Calendar',
    'action' => 'year',
    'yearNumber' => date('Y')
), Route::ONE_WAY);

$container->router[] = new Route('<yearNumber [0-9]+>', 'Calendar:year');
$container->router[] = new Route('<yearNumber [0-9]+>/<monthNumber [0-9]+>', 'Calendar:month');
$container->router[] = new Route('<yearNumber [0-9]+>/<monthNumber [0-9]+>/<dayNumber [0-9]+>', 'Calendar:day');

setlocale(LC_ALL, "cs_CZ.utf-8");

// Configure and run the application!
$container->application->run();

<?php

use DI\ContainerBuilder;
use Slim\App;

$ROOT_DIR = __DIR__ . '/../..';

require_once $ROOT_DIR . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

// Set up container
$containerBuilder->addDefinitions($ROOT_DIR . '/config/container.php');

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Create App instance
$app = $container->get(App::class);

// Register routes
(require $ROOT_DIR . '/config/web/routes.php')($app);

// Register middleware
(require $ROOT_DIR . '/config/web/middleware.php')($app);

$app->run();
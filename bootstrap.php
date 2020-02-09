<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/config/container.php');

return $containerBuilder->build();

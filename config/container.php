<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

return [
    App::class => static function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        $app = AppFactory::create();

        (require __DIR__ . '/routes.php')($app);

        $app->addRoutingMiddleware();
        $app->addErrorMiddleware(true, true, true);

        return $app;
    },
];

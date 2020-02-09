<?php

declare(strict_types=1);

use Radarlog\Micker\Infrastructure\Api\Controller;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/api/v1', function (RouteCollectorProxy $group) {

        $group->get('/time/{timestamp:[0-9]+}', Controller\Timestamp::class);
    });
};

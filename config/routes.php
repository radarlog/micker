<?php

declare(strict_types=1);

use Radarlog\Micker\Infrastructure\Api\Controller;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return static function (App $app): void {
    // phpcs:disable SlevomatCodingStandard.Functions.StaticClosure
    $app->group('/api/v1', function (RouteCollectorProxy $group): void {
        $group->get('/time/{timestamp:[0-9]+}', Controller\Timestamp::class);
    });
};

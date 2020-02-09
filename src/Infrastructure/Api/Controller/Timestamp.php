<?php

declare(strict_types=1);

namespace Radarlog\Micker\Infrastructure\Api\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Radarlog\Micker\Application;
use Radarlog\Micker\Infrastructure\Api\Controller;

final class Timestamp implements Controller
{
    private Application\QueryByTimestamp $useCase;

    public function __construct(Application\QueryByTimestamp $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $timestamp = (int) $request->getAttribute('timestamp');

        $clock = ($this->useCase)($timestamp);

        $body = [
            'mars_sol_date' => $clock->marsSolDate(),
            'martian_coordinated_time' => $clock->martianCoordinatedTime(),
        ];

        return new Response(
            self::HTTP_OK,
            ['content-type' => 'application/json'],
            json_encode($body)
        );
    }
}

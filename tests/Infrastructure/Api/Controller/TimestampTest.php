<?php

declare(strict_types=1);

namespace Radarlog\Micker\Tests\Infrastructure\Api\Controller;

use Nyholm\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Slim\App;

class TimestampTest extends TestCase
{
    private const TIMESTAMP = 1581144317;

    private const RESPONSE = [
        'mars_sol_date' => 51937.94038,
        'martian_coordinated_time' => '22:34:09',
    ];

    private ResponseInterface $response;

    protected function setUp(): void
    {
        parent::setUp();

        $request = new ServerRequest(
            'GET',
            sprintf('/api/v1/time/%d', self::TIMESTAMP),
        );

        $container = require __DIR__ . '/../../../../bootstrap.php';

        $app = $container->get(App::class);

        $this->response = $app->handle($request);
    }

    public function testStatusCode(): void
    {
        self::assertSame(200, $this->response->getStatusCode());
    }

    public function testContentType(): void
    {
        self::assertSame('application/json', $this->response->getHeaderLine('content-type'));
    }

    public function testBody(): void
    {
        $json = json_decode((string) $this->response->getBody(), true, 512, JSON_THROW_ON_ERROR);

        self::assertEquals(self::RESPONSE, $json);
    }
}

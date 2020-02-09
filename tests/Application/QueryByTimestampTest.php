<?php

declare(strict_types=1);

namespace Radarlog\Micker\Tests\Application;

use PHPUnit\Framework\TestCase;
use Radarlog\Micker\Application;
use Radarlog\Micker\Domain;

class QueryByTimestampTest extends TestCase
{
    public function testUseCase(): void
    {
        $datetime = new \DateTimeImmutable('8 Feb 2020 06:45:17 UTC');

        $useCase = new Application\QueryByTimestamp();

        self::assertEquals(new Domain\Clock($datetime), $useCase($datetime->getTimestamp()));
    }
}

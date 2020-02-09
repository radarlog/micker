<?php

declare(strict_types=1);

namespace Radarlog\Micker\Tests\Domain;

use PHPUnit\Framework\TestCase;
use Radarlog\Micker\Domain\Clock;

class ClockTest extends TestCase
{
    public function marsSolDateProvider(): iterable
    {
        yield [(new \DateTimeImmutable('8 Feb 2020 06:45:17 UTC'))->getTimestamp(), 51937.94038];
        yield [(new \DateTimeImmutable('9 Feb 2020 14:44:22 UTC'))->getTimestamp(), 51939.23742];
        yield [(new \DateTimeImmutable('2 Feb 2222 22:22:22 UTC'))->getTimestamp(), 123737.72517];
    }

    /**
     * @dataProvider marsSolDateProvider
     */
    public function testMarsSolDate(int $utcTimestamp, float $marsSolDate): void
    {
        $clock = new Clock($utcTimestamp);

        self::assertSame($marsSolDate, $clock->marsSolDate());
    }
}

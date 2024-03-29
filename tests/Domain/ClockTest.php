<?php

declare(strict_types=1);

namespace Radarlog\Micker\Tests\Domain;

use PHPUnit\Framework\TestCase;
use Radarlog\Micker\Domain\Clock;

class ClockTest extends TestCase
{
    /**
     * @return iterable<string,array{\DateTimeInterface,float}>
     */
    public static function marsSolDateProvider(): iterable
    {
        yield '8 Feb 2020' => [new \DateTimeImmutable('8 Feb 2020 06:45:17 UTC'), 51937.94038];
        yield '9 Feb 2020' => [new \DateTimeImmutable('9 Feb 2020 14:44:22 UTC'), 51939.23742];
        yield '2 Feb 2222' => [new \DateTimeImmutable('2 Feb 2222 22:22:22 UTC'), 123737.72517];
    }

    /**
     * @dataProvider marsSolDateProvider
     */
    public function testMarsSolDate(\DateTimeInterface $dateTime, float $marsSolDate): void
    {
        $clock = new Clock($dateTime);

        self::assertSame($marsSolDate, $clock->marsSolDate());
    }

    /**
     * @return iterable<string,array{\DateTimeInterface,string}>
     */
    public static function martianCoordinatedTime(): iterable
    {
        yield '8 Feb 2020' => [new \DateTimeImmutable('8 Feb 2020 06:45:17 UTC'), '22:34:09'];
        yield '9 Feb 2020' => [new \DateTimeImmutable('9 Feb 2020 14:44:22 UTC'), '05:41:53'];
        yield '2 Feb 2222' => [new \DateTimeImmutable('2 Feb 2222 22:22:22 UTC'), '17:24:15'];
    }

    /**
     * @dataProvider martianCoordinatedTime
     */
    public function testMartianCoordinatedTime(\DateTimeInterface $dateTime, string $mct): void
    {
        $clock = new Clock($dateTime);

        self::assertSame($mct, $clock->martianCoordinatedTime());
    }
}

<?php

declare(strict_types=1);

namespace Radarlog\Micker\Domain;

final class Clock
{
    private const SECONDS_PER_SOL = 88775.244147;

    private const LEAP_SECONDS = 37;

    private const MSD_PRECISION = 5;

    private float $marsSolDate;

    public function __construct(int $utcTimestamp)
    {
        $marsSolDate = ($utcTimestamp + self::LEAP_SECONDS) / self::SECONDS_PER_SOL + 34127.2954262;

        $this->marsSolDate = round($marsSolDate, self::MSD_PRECISION, PHP_ROUND_HALF_UP);
    }

    public function marsSolDate(): float
    {
        return $this->marsSolDate;
    }
}

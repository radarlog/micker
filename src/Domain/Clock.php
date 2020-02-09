<?php

declare(strict_types=1);

namespace Radarlog\Micker\Domain;

final class Clock
{
    private const SECONDS_PER_SOL = 88775.244147;

    private const LEAP_SECONDS = 37;

    private const MSD_PRECISION = 5;

    private const MCT_FORMAT = 'H:i:s';

    private float $marsSolDate;

    private string $martianCoordinatedTime;

    public function __construct(\DateTimeInterface $dateTime)
    {
        $timestamp = $dateTime->getTimestamp();

        $marsSolDate = ($timestamp + self::LEAP_SECONDS) / self::SECONDS_PER_SOL + 34127.2954262;

        $this->marsSolDate = round($marsSolDate, self::MSD_PRECISION, PHP_ROUND_HALF_UP);

        $martianCoordinatedTime = round(fmod($marsSolDate, 1) * 86400, 0, PHP_ROUND_HALF_UP);

        $this->martianCoordinatedTime = gmdate(self::MCT_FORMAT, (int) $martianCoordinatedTime);
    }

    public function marsSolDate(): float
    {
        return $this->marsSolDate;
    }

    public function martianCoordinatedTime(): string
    {
        return $this->martianCoordinatedTime;
    }
}

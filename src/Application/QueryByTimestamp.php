<?php

declare(strict_types=1);

namespace Radarlog\Micker\Application;

use Radarlog\Micker\Domain;

final class QueryByTimestamp
{
    public function __invoke(int $timestamp): Domain\Clock
    {
        $datetime = new \DateTimeImmutable(sprintf('@%d', $timestamp));

        return new Domain\Clock($datetime);
    }
}

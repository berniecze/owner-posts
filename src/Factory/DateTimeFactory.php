<?php
declare(strict_types=1);

namespace App\Factory;

class DateTimeFactory implements DateTimeFactoryInterface
{
    private const string NOW = 'now';

    public function nowImmutable(): \DateTimeImmutable
    {
        return new \DateTimeImmutable(self::NOW);
    }
}

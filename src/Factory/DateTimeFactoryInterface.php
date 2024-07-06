<?php

namespace App\Factory;

use DateTime;
use DateTimeImmutable;

interface DateTimeFactoryInterface
{
    public function nowImmutable(): DateTimeImmutable;
}

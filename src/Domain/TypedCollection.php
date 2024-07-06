<?php

declare(strict_types=1);

namespace App\Domain;

abstract class
TypedCollection extends Collection
{
    /** @param array<mixed> $elements */
    public function __construct(array $elements = [])
    {
        parent::__construct($elements);
    }

    abstract protected function type(): string;
}

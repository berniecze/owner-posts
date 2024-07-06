<?php
declare(strict_types=1);

namespace App\Domain\Post;

readonly class TextPost
{


    public function __construct(
        public string $content,
    )
    {
    }
}

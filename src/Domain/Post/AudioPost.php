<?php
declare(strict_types=1);

namespace App\Domain\Post;

readonly class AudioPost
{


    public function __construct(
        public string $fileUrl,
        public int $audioLength,
    )
    {
    }
}

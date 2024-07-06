<?php
declare(strict_types=1);

namespace App\Request;

readonly class CreatePostRequest
{


    public function __construct(
        public int     $userId,
        public string  $title,
        public ?string $content,
        public ?string $audioUrl,
        public ?int    $duration,
        public string  $perex
    )
    {
    }
}

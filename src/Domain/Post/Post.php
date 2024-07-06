<?php
declare(strict_types=1);

namespace App\Domain\Post;

use App\Enum\PostTypeEnum;

readonly class Post
{

    public function __construct(
        public string $authorName,
        public string $title,
        public \DateTimeImmutable $publicationDate,
        public string $perex,
        public ?TextPost $textPost,
        public ?AudioPost $audioPost,
        public PostTypeEnum $enum
    )
    {
    }
}

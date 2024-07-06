<?php
declare(strict_types=1);

namespace App\Domain\Post;

use App\Domain\TypedCollection;

class PostCollection extends TypedCollection
{
    protected function type(): string
    {
        return Post::class;
    }
}

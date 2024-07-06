<?php
declare(strict_types=1);

namespace App\Service;

use App\Domain\Post\PostCollection;
use App\Repository\PostRepository;
use App\Transformer\PostsTransformer;

readonly class PostsService
{


    public function __construct(
        private PostRepository   $postRepository,
        private PostsTransformer $postsTransformer
    ) {
    }

    public function getPostsForUser(int $userId): PostCollection
    {
        $posts = $this->postRepository->findByUserOrderedByDate($userId);

        return $this->postsTransformer->transform($posts);
    }
}

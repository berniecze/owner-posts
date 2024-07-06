<?php
declare(strict_types=1);

namespace App\Transformer;

use App\Domain\Post\PostCollection;
use App\Entity\Post;
use App\Enum\PostTypeEnum;

class PostsTransformer
{

    /** @param array<Post> $posts */
    public function transform(array $posts): PostCollection
    {
        return PostCollection::fromMap($posts, fn(Post $post) => $this->transformPost($post));
    }

    private function transformPost(Post $post): \App\Domain\Post\Post
    {
        $audio = null;
        $text = null;
        if ($post->getAudio() !== null) {
            $audio = new \App\Domain\Post\AudioPost(
                $post->getAudio()->getAudioUrl(),
                $post->getAudio()->getLength()
            );
        }

        if ($post->getText() !== null) {
            $audio = new \App\Domain\Post\TextPost(
                $post->getText()->getText(),
            );
        }
        return new \App\Domain\Post\Post(
            $post->getUser()?->getUsername() ?? '',
            $post->getTitle(),
            $post->getPublicationDate() ?? new \DateTimeImmutable(),
            $post->getPerex(),
            $text,
            $audio,
            $audio !== null ?  PostTypeEnum::AUDIO : PostTypeEnum::TEXT
        );
    }
}

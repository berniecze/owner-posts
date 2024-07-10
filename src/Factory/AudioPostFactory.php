<?php
declare(strict_types=1);

namespace App\Factory;

use App\Entity\AudioPost;
use App\Entity\Post;
use App\Entity\User;
use App\Enum\PostTypeEnum;
use Doctrine\ORM\EntityManagerInterface;

readonly class AudioPostFactory
{

    public function __construct(
        private DateTimeFactoryInterface $dateTimeFactory,
        private EntityManagerInterface   $entityManager
    ) {
    }

    public function create(User $user, string $title, int $duration, string $audioUrl, string $perex): void
    {
        $post = new Post();
        $post->setUser($user);
        $post->setTitle($title);
        $post->setPerex($perex);
        $post->setPublicationDate($this->dateTimeFactory->nowImmutable());
        $post->setType(PostTypeEnum::AUDIO->value);
        $this->entityManager->persist($post);
        $this->entityManager->flush();

        $audioPost = new AudioPost();
        $audioPost->setDuration($duration);
        $audioPost->setFileUrl($audioUrl);

        $post->setAudioPost($audioPost);
        $this->entityManager->persist($post);
        $this->entityManager->persist($audioPost);
        $this->entityManager->flush();
    }
}

<?php
declare(strict_types=1);

namespace App\Factory;

use App\Entity\Post;
use App\Entity\TextPost;
use App\Entity\User;
use App\Enum\PostTypeEnum;
use Doctrine\ORM\EntityManagerInterface;

readonly class TextPostFactory
{


    public function __construct(
        private DateTimeFactoryInterface $dateTimeFactory,
        private EntityManagerInterface   $entityManager
    ) {
    }

    public function create(User $user, string $title, string $content, string $perex): void
    {
        $post = new Post();
        $post->setTitle($title);
        $post->setUser($user);
        $post->setPublicationDate($this->dateTimeFactory->nowImmutable());
        $post->setPerex($perex);
        $post->setType(PostTypeEnum::TEXT->value);
        $this->entityManager->persist($post);
        $this->entityManager->flush();

        $textPost = new TextPost();
        $textPost->setText($content);
        $post->setTextPost($textPost);

        $this->entityManager->persist($textPost);
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }
}

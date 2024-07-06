<?php
declare(strict_types=1);

namespace App\Factory;

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
        $post = new TextPost();
        $post->setTitle($title);
        $post->setText($content);
        $post->setUser($user);
        $post->setPublicationDate($this->dateTimeFactory->nowImmutable());
        $post->setPerex($perex);
        $post->setType(PostTypeEnum::TEXT->value);

        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }
}

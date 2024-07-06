<?php
declare(strict_types=1);

namespace App\Facade;

use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Factory\AudioPostFactory;
use App\Factory\TextPostFactory;
use App\Repository\UserRepository;
use App\Request\CreatePostRequest;

readonly class PostsFacade
{


    public function __construct(
        private AudioPostFactory $audioPostFactory,
        private TextPostFactory $textPostFactory,
        private UserRepository   $repository
    )
    {
    }

    public function createPost(CreatePostRequest $request): void
    {
        $user = $this->repository->findOneBy(['id' => $request->userId]);
        if ($user === null) {
            throw new UserNotFoundException();
        }

        if ($request->audioUrl !== null && $request->duration !== null) {
            $this->createAudioPost($user, $request->title, $request->duration, $request->audioUrl, $request->perex);
        }

        if ($request->content !== null) {
            $this->createTextPost($user, $request->title, $request->content, $request->perex);
        }
    }

    private function createAudioPost(User $user, string $title, int $duration, string $audioUrl, string $perex): void
    {
        $this->audioPostFactory->create($user, $title, $duration, $audioUrl, $perex);
    }

    private function createTextPost(User $user, string $title, string $content, string $perex): void
    {
        $this->textPostFactory->create($user, $title, $content, $perex);
    }
}

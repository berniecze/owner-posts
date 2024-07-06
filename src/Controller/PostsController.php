<?php
declare(strict_types=1);

namespace App\Controller;

use App\Exception\UserNotFoundException;
use App\Facade\PostsFacade;
use App\Request\CreatePostRequest;
use App\Service\PostsService;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostsController
{

    #[Route('/posts', name: 'get_post', methods: ['GET'])]
    public function getPosts(Request $request, PostsService $service, LoggerInterface $logger): JsonResponse
    {
        try {
            if ($request->query->has('userId') === false) {
                return new JsonResponse(['error' => 'missing user id'], Response::HTTP_BAD_REQUEST);
            }

            $postsCollection = $service->getPostsForUser($request->query->getInt('userId'));

            return new JsonResponse($postsCollection->jsonSerialize(), Response::HTTP_OK);
        } catch (\Exception $e) {
            $logger->error('Error while fetching posts', ['error' => $e->getMessage(), 'userId' => $request->query->get('userId')]);
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/posts', name: 'create_post', methods: ['POST'])]
    public function createPost(Request $request, PostsFacade $facade, LoggerInterface $logger): JsonResponse
    {
        try {
            if ($request->query->has('userId') === false) {
                return new JsonResponse(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }

            $requestDTO = new CreatePostRequest(
                $request->query->getInt('userId'),
                $request->request->get('title'),
                $request->request->get('content'),
                $request->request->get('audioUrl'),
                $request->request->getInt('duration'),
                $request->request->get('perex'),
            );

            $facade->createPost($requestDTO);

            return new JsonResponse(null, Response::HTTP_CREATED);
        } catch (UserNotFoundException $e) {
            $logger->info('User does not exists', ['error' => $e->getMessage(), 'userId' => $request->query->get('userId')]);
            return new JsonResponse(['error' => 'UserId not found'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            $logger->error('Error while creating post', ['error' => $e->getMessage(), 'userId' => $request->query->get('userId')]);
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

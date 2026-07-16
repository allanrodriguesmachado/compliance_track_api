<?php

namespace App\Controller\Api;

use App\Domain\User\DTO\CreateUserDTO;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\Service\UserRegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{

    public function __construct(
        public UserRegistrationService $userRegistrationService
    )
    {
    }

    #[Route('/api/user/create', name: 'api_user_create', methods: ['POST'])]
    public function user(#[MapRequestPayload] CreateUserDTO $createUserDTO): JsonResponse
    {
        $user = $this->userRegistrationService->execute($createUserDTO);

        $this->userRepository->createUser($user);
        return new JsonResponse(['message' => 'User created successfully']);
    }
}

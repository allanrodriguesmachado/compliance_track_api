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
        $this->userRegistrationService->execute($createUserDTO);

        return new JsonResponse(['message' => 'User created successfully']);
    }

    #[Route('/api/user/login', name: 'api_user_login', methods: ['POST'])]
    public function login(): JsonResponse
    {
        // O Symfony intercepta a requisição ANTES de chegar aqui.
        // Se o código passar por aqui, é porque o security.yaml está com o caminho errado.
        throw new \RuntimeException('O firewall do JWT não interceptou a rota.');
    }
}

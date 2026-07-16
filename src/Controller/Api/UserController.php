<?php

namespace App\Controller\Api;

use App\Domain\User\DTO\CreateUserDTO;
use App\Domain\User\DTO\FindByEmailDTO;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\Service\UserRegistrationService;
use Doctrine\ORM\EntityManagerInterface;
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
        throw new \RuntimeException('O firewall do JWT não interceptou a rota.');
    }

    #[Route('/api/user/find-by-email', name: 'api_user_find_by_email', methods: ['POST'])]
    public function findByEmail(#[MapRequestPayload] FindByEmailDTO $createUserDTO, EntityManagerInterface $entityManager): JsonResponse
    {
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $createUserDTO->email]);
        if(!$user) {
            return new JsonResponse([
                'message' => 'User not found.',
            ]);
        }

        return new JsonResponse([
            'fullName' => $user->firstName . ' ' . $user->lastName,
            'email' => $user->email,
            'cargo' => $user->accessLevel,
            'createdAt' => $user->createdAt->format('Y-m-d H:i:s'),
        ]);
    }
}

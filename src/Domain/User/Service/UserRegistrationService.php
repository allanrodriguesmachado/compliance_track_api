<?php

namespace App\Domain\User\Service;

use App\Domain\User\DTO\CreateUserDTO;
use App\Domain\User\DTO\FindByEmailDTO;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\Repository\UserRepositoryInterface;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserRegistrationService
{
    public function __construct(
        public UserRepositoryInterface $userRepository,
        public UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function execute(CreateUserDTO $createUserDTO): ?User
    {
        $user = new User();
        $user->firstName = $createUserDTO->firstName;
        $user->lastName = $createUserDTO->lastName;
        $user->email = $createUserDTO->email;
        $user->accessLevel = $createUserDTO->accessLevel;
        $user->password = $this->passwordHasher->hashPassword($user, $createUserDTO->password);

        return $this->userRepository->createUser($user);
    }

    public function findByEmail(FindByEmailDTO $findByEmailDTO): ?User
    {
        return $this->userRepository->findUserByEmail($findByEmailDTO);
    }
}

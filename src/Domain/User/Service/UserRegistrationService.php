<?php

namespace App\Domain\User\Service;

use App\Domain\User\DTO\CreateUserDTO;
use App\Domain\User\DTO\FindByEmailDTO;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepository;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserRegistrationService
{
    public function __construct(
        public UserRepository $userRepository,
        public UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function execute(CreateUserDTO $createUserDTO): void
    {
        $this->passwordHasher->hashPassword($createUserDTO, $createUserDTO->password);

        $user = new User();
        $user->firstName = $createUserDTO->firstName;
        $user->lastName = $createUserDTO->lastName;
        $user->email = $createUserDTO->email;
        $user->accessLevel = $createUserDTO->accessLevel;
        $user->password = $this->passwordHasher->hashPassword($user, $createUserDTO->password);

        $this->userRepository->createUser($user);
    }

    public function findByEmail(FindByEmailDTO $findByEmailDTO): ?User
    {
        return $this->userRepository->findUserByEmail($findByEmailDTO);
    }
}

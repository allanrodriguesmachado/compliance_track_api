<?php

namespace App\Domain\User\Service;

use App\Domain\User\DTO\CreateUserDTO;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepository;
use phpDocumentor\Reflection\Types\Void_;

class UserRegistrationService
{
    public function __construct(
        public UserRepository $userRepository,
    )
    {
    }

    public function execute(CreateUserDTO $createUserDTO): void
    {
        $user = new User();
        $user->firstName = $createUserDTO->firstName;
    }
}

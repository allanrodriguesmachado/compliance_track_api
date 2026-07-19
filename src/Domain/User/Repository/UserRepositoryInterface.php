<?php

namespace App\Domain\User\Repository;

use App\Domain\User\DTO\CreateUserDTO;
use App\Domain\User\DTO\FindByEmailDTO;
use App\Domain\User\Entity\User;

interface UserRepositoryInterface
{
    public function createUser(User $user): User;

    public function findUserByEmail(FindByEmailDTO $findByEmailDTO): ?User;
}

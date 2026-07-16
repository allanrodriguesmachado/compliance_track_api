<?php

namespace App\Domain\User\DTO;

use App\Domain\User\Enum\AccessLevel;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CreateUserDTO implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
        public ?AccessLevel $accessLevel = AccessLevel::LEADER,
    )
    {
    }

    public function getRoles(): array
    {
        $role = $this->accessLevel->value;

        return ['ROLE_USER', 'ROLE_' . strtoupper($role)];
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
    }
}

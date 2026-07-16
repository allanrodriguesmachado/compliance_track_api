<?php

namespace App\Domain\User\DTO;

class CreateUserDTO
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
    )
    {
    }
}

<?php

namespace App\Domain\User\DTO;

class FindByEmailDTO
{
    public function __construct(
        public string $email
    )
    {
    }
}

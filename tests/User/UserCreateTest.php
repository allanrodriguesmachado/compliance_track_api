<?php

namespace App\Tests\User;

use App\Domain\User\DTO\CreateUserDTO;
use App\Domain\User\DTO\FindByEmailDTO;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\Service\UserRegistrationService;
use PhpCsFixer\Hasher;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCreateTest extends TestCase
{
    public function testCreateUser()
    {
        $createUserDTO = new CreateUserDTO('Allan', 'Rodrigues', 'allan2132@php.com', 'Aln@830314');

        $baseMock = $this->createMock(UserRepositoryInterface::class);

//        $baseMock->expects($this->once())->method('findUserByEmail')->willReturn('allan2132@php.com');

        $baseMock->expects($this->once())->method('createUser');

        $hasherMock = $this->createMock(UserPasswordHasherInterface::class);
        $hasherMock->expects($this->once())->method('hashPassword')->willReturn('Aln@830314');

        $service = new UserRegistrationService($baseMock, $hasherMock);

        $userCreated = $service->execute($createUserDTO);


        $this->assertInstanceOf(User::class, $userCreated);
   }
}

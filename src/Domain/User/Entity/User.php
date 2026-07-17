<?php

namespace App\Domain\User\Entity;

use App\Domain\User\Enum\AccessLevel;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    public string $firstName;
    #[ORM\Column(length: 255)]
    public string $lastName;

    #[Groups(['user:read'])]
    #[ORM\Column(length: 255, options: ['unique' => true])]
    public string $email;

    #[ORM\Column(length: 255)]
    public string $password;

    #[ORM\Column(enumType: AccessLevel::class, options: ['default' => 'member'])]
    public AccessLevel $accessLevel;

    #[Groups(['user:read'])]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s'])]
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    public \DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    public ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->accessLevel = AccessLevel::MEMBER;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
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

    #[Groups(['user:read'])]
    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}

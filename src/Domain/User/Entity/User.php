<?php

namespace App\Domain\User\Entity;

use App\Domain\User\Enum\AccessLevel;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    public string $firstName;

    #[ORM\Column(length: 255)]
    public string $lastName;

    #[ORM\Column(length: 255)]
    public string $email;

    #[ORM\Column(length: 255)]
    public string $password;

    #[ORM\Column(enumType: AccessLevel::class, options: ['default' => 'member'])]
    public AccessLevel $userRole;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    public \DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    public ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->userRole = AccessLevel::MEMBER;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}

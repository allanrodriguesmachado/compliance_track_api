<?php

namespace App\Domain\User\Repository;

use App\Domain\User\DTO\FindByEmailDTO;
use App\Domain\User\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function createUser(User $user): User
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
        return $user;
    }

    public function findUserByEmail(FindByEmailDTO $findByEmailDTO): ?User
    {
         return $this->createQueryBuilder('u')
            ->where('u.email = :email')
            ->setParameter('email', $findByEmailDTO->email)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

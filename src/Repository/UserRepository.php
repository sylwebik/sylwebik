<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAllByRoleQB($role)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :role')
            ->setParameter('role', '%'.$role.'%');
    }

    public function findAllByCourseId($course_id)
    {
        return $this->createQueryBuilder('u')
            ->innerJoin('u.courses','uc')
            ->innerJoin('uc.course', 'c')
            ->where('c.id = :course_id')
            ->setParameter('course_id', $course_id)
            ->getQuery()
            ->getResult();
    }

    public function findAllTeacherByUserIdQB($id)
    {
        return $this->createQueryBuilder('u')
            ->innerJoin('u.courses', 'uc')
            ->innerJoin('uc.course', 'c')
            ->innerJoin('c.owner', 'o')
            ->where('u.id = :id')
            ->setParameter('id', $id);
    }

    public function findById($id)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}

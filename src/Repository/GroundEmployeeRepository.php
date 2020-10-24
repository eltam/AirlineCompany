<?php

namespace App\Repository;

use App\Entity\GroundEmployee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroundEmployee|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroundEmployee|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroundEmployee[]    findAll()
 * @method GroundEmployee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroundEmployeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroundEmployee::class);
    }

    // /**
    //  * @return GroundEmployee[] Returns an array of GroundEmployee objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroundEmployee
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

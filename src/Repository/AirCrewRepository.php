<?php

namespace App\Repository;

use App\Entity\AirCrew;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AirCrew|null find($id, $lockMode = null, $lockVersion = null)
 * @method AirCrew|null findOneBy(array $criteria, array $orderBy = null)
 * @method AirCrew[]    findAll()
 * @method AirCrew[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirCrewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AirCrew::class);
    }

    // /**
    //  * @return AirCrew[] Returns an array of AirCrew objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AirCrew
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

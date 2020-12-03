<?php

namespace App\Repository;

use App\Entity\Ticket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ticket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ticket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ticket[]    findAll()
 * @method Ticket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }

    /**
     * @param $user
     * @return int|mixed|string
     */
    public function findByUser($user)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.user = :val')
            ->setParameter('val', $user)
            ->orderBy('t.issue_date', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findNextCount()
    {
        return $this->createQueryBuilder('t')
            ->select('count(t.id)')
            ->leftJoin('t.departure', 'd')
            ->where('d.departure_date > CURRENT_DATE()')
            ->getQuery()
            ->getSingleScalarResult();
    }

    // /**
    //  * @return Ticket[] Returns an array of Ticket objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ticket
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

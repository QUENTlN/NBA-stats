<?php

namespace App\Repository;

use App\Entity\Comparison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comparison|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comparison|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comparison[]    findAll()
 * @method Comparison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComparisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comparison::class);
    }

    // /**
    //  * @return Comparison[] Returns an array of Comparison objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Comparison
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

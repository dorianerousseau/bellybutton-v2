<?php

namespace App\Repository;

use App\Entity\StatsIG;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatsIG|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatsIG|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatsIG[]    findAll()
 * @method StatsIG[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatsIGRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatsIG::class);
    }

    // /**
    //  * @return StatsIG[] Returns an array of StatsIG objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatsIG
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

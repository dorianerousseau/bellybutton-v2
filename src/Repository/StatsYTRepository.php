<?php

namespace App\Repository;

use App\Entity\StatsYT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatsYT|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatsYT|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatsYT[]    findAll()
 * @method StatsYT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatsYTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatsYT::class);
    }

    // /**
    //  * @return StatsYT[] Returns an array of StatsYT objects
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
    public function findOneBySomeField($value): ?StatsYT
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

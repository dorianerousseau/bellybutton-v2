<?php

namespace App\Repository;

use App\Entity\StatsTK;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatsTK|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatsTK|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatsTK[]    findAll()
 * @method StatsTK[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatsTKRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatsTK::class);
    }

    // /**
    //  * @return StatsTK[] Returns an array of StatsTK objects
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
    public function findOneBySomeField($value): ?StatsTK
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

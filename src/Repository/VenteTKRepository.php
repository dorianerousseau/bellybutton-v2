<?php

namespace App\Repository;

use App\Entity\InfluenceurManagement\VenteTK;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VenteTK|null find($id, $lockMode = null, $lockVersion = null)
 * @method VenteTK|null findOneBy(array $criteria, array $orderBy = null)
 * @method VenteTK[]    findAll()
 * @method VenteTK[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VenteTKRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VenteTK::class);
    }

    // /**
    //  * @return VenteTK[] Returns an array of VenteTK objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VenteTK
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

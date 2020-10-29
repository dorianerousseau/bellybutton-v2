<?php

namespace App\Repository;

use App\Entity\InfluenceurManagement\VenteTW;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VenteTW|null find($id, $lockMode = null, $lockVersion = null)
 * @method VenteTW|null findOneBy(array $criteria, array $orderBy = null)
 * @method VenteTW[]    findAll()
 * @method VenteTW[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VenteTWRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VenteTW::class);
    }

    // /**
    //  * @return VenteTW[] Returns an array of VenteTW objects
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
    public function findOneBySomeField($value): ?VenteTW
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

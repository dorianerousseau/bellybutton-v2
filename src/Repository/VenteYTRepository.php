<?php

namespace App\Repository;

use App\Entity\InfluenceurManagement\VenteYT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VenteYT|null find($id, $lockMode = null, $lockVersion = null)
 * @method VenteYT|null findOneBy(array $criteria, array $orderBy = null)
 * @method VenteYT[]    findAll()
 * @method VenteYT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VenteYTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VenteYT::class);
    }

    // /**
    //  * @return VenteYT[] Returns an array of VenteYT objects
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
    public function findOneBySomeField($value): ?VenteYT
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

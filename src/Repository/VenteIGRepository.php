<?php

namespace App\Repository;

use App\Entity\InfluenceurManagement\VenteIG;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VenteIG|null find($id, $lockMode = null, $lockVersion = null)
 * @method VenteIG|null findOneBy(array $criteria, array $orderBy = null)
 * @method VenteIG[]    findAll()
 * @method VenteIG[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VenteIGRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VenteIG::class);
    }

    // /**
    //  * @return VenteIG[] Returns an array of VenteIG objects
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
    public function findOneBySomeField($value): ?VenteIG
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

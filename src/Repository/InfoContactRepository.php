<?php

namespace App\Repository;

use App\Entity\infoContact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method infoContact|null find($id, $lockMode = null, $lockVersion = null)
 * @method infoContact|null findOneBy(array $criteria, array $orderBy = null)
 * @method infoContact[]    findAll()
 * @method infoContact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, infoContact::class);
    }

    // /**
    //  * @return infoContact[] Returns an array of infoContact objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?infoContact
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

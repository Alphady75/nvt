<?php

namespace App\Repository;

use App\Entity\PalEurope;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PalEurope|null find($id, $lockMode = null, $lockVersion = null)
 * @method PalEurope|null findOneBy(array $criteria, array $orderBy = null)
 * @method PalEurope[]    findAll()
 * @method PalEurope[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PalEuropeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PalEurope::class);
    }

    // /**
    //  * @return PalEurope[] Returns an array of PalEurope objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PalEurope
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

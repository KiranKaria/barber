<?php

namespace App\Repository;

use App\Entity\Behandeling;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Behandeling|null find($id, $lockMode = null, $lockVersion = null)
 * @method Behandeling|null findOneBy(array $criteria, array $orderBy = null)
 * @method Behandeling[]    findAll()
 * @method Behandeling[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BehandelingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Behandeling::class);
    }

    // /**
    //  * @return Behandeling[] Returns an array of Behandeling objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Behandeling
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

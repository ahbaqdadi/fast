<?php

namespace App\Repository;

use App\Entity\CartNumber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CartNumber|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartNumber|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartNumber[]    findAll()
 * @method CartNumber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartNumberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartNumber::class);
    }

    // /**
    //  * @return CartNumber[] Returns an array of CartNumber objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CartNumber
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

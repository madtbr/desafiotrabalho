<?php

namespace App\Repository;

use App\Entity\Salarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Salarios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Salarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Salarios[]    findAll()
 * @method Salarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalariosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Salarios::class);
    }

    // /**
    //  * @return Salarios[] Returns an array of Salarios objects
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
    public function findOneBySomeField($value): ?Salarios
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

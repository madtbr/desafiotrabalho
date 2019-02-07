<?php

namespace App\Repository;

use App\Entity\Documentos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Documentos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Documentos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Documentos[]    findAll()
 * @method Documentos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Documentos::class);
    }

    // /**
    //  * @return Documentos[] Returns an array of Documentos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Documentos
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

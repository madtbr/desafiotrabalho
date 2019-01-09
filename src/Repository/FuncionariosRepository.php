<?php

namespace App\Repository;

use App\Entity\Funcionarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Funcionarios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Funcionarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Funcionarios[]    findAll()
 * @method Funcionarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FuncionariosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Funcionarios::class);
    }

    // /**
    //  * @return Funcionarios[] Returns an array of Funcionarios objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Funcionarios
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

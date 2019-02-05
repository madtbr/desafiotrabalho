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
    public function countAll()
    {
        return $this->createQueryBuilder('f')
            ->select('count(f.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    
    public function getFuncionarioAtivoPorData($dataInicio, $dataFim, $status)
    {
        $q = $this->createQueryBuilder("f");
        $campo = false;
            if($status == '1'){
                $campo = 'f.data_admissao';
            }elseif($status == '0' and 'f.data_exoneracao' != null){
                $campo = 'f.data_exoneracao';
            }
            $q->where(
                $q->expr()->between($campo, ':data1', ':data2')
            );
            $q->andWhere("f.status = '$status'");
            $q->setParameter('data1', $dataInicio->format('Y-m-d'));
            $q->setParameter('data2', $dataFim->format('Y-m-d'));
        return $q->getQuery()->getResult();
    }
    public function salarioTotal()
    {
        // $q = $this->createQueryBuilder("f")
        //     ->select('s.nome, SUM(r.salario) as total')
        //     ->join("App\Entity\Secretarias", 's', Join::WITH, 'f.secretaria_id = s.id')
        //     ->join("App\Entity\Salarios", 'r', Join::WITH, 'f.salario_id = r.id')
        //     ->where('f.status = :status ')
        //     ->groupBy("s.nome")
        //     ->setParameter(':status', '1')
        //     ->getQuery();
        // return $q->getResult();
    }
}

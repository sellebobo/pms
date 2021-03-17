<?php

namespace App\Repository;

use App\Entity\Banque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use  Doctrine\ORM\QueryBuilder;

/**
 * @method Banque|null find($id, $lockMode = null, $lockVersion = null)
 * @method Banque|null findOneBy(array $criteria, array $orderBy = null)
 * @method Banque[]    findAll()
 * @method Banque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BanqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Banque::class);
    }

    public function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('b')
            ->select('b')
            ->andWhere('b.status =true');
    }


    public function testUniqueEntityNameBank($params): ?Banque
    {
        return $this->findVisibleQuery()
            ->andWhere('b.name =:name')
            ->andWhere('b.status =true')
            ->setParameter('name', $params["name"])
            ->getQuery()
            ->getOneOrNullResult();
    }

    // /**
    //  * @return Banque[] Returns an array of Banque objects
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
    public function findOneBySomeField($value): ?Banque
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

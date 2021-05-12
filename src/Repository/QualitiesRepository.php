<?php

namespace App\Repository;

use App\Entity\Qualities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Qualities|null find($id, $lockMode = null, $lockVersion = null)
 * @method Qualities|null findOneBy(array $criteria, array $orderBy = null)
 * @method Qualities[]    findAll()
 * @method Qualities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QualitiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Qualities::class);
    }

    // /**
    //  * @return Qualities[] Returns an array of Qualities objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Qualities
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

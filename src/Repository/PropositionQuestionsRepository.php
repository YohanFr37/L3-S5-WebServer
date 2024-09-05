<?php

namespace App\Repository;

use App\Entity\PropositionQuestions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PropositionQuestions|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropositionQuestions|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropositionQuestions[]    findAll()
 * @method PropositionQuestions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropositionQuestionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PropositionQuestions::class);
    }

    

    // /**
    //  * @return PropositionQuestions[] Returns an array of PropositionQuestions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PropositionQuestions
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

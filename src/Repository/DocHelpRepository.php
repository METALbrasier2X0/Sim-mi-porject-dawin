<?php

namespace App\Repository;

use App\Entity\DocHelp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DocHelp|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocHelp|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocHelp[]    findAll()
 * @method DocHelp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocHelpRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DocHelp::class);
    }

    // /**
    //  * @return DocHelp[] Returns an array of DocHelp objects
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
    public function findOneBySomeField($value): ?DocHelp
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

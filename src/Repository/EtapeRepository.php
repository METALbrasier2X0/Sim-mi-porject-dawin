<?php

namespace App\Repository;

use App\Entity\Etape;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Etape|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etape|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etape[]    findAll()
 * @method Etape[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtapeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Etape::class);
    }

    public function findEtapes(int $id1, int $id2, int $id3, int $id4, int $id5){

        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM App:Etape e WHERE e.id ='.$id1.' UNION SELECT p FROM App:Etape p WHERE e.id ='.$id2.' UNION SELECT p FROM App:Etape p WHERE e.id ='.$id3.' UNION SELECT p FROM App:Etape p WHERE e.id ='.$id4.' UNION SELECT p FROM App:Etape p WHERE e.id ='.$id5.''
            )
            ->getResult();
    }
    



    // /**
    //  * @return Etape[] Returns an array of Etape objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Etape
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

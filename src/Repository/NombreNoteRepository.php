<?php

namespace App\Repository;

use App\Entity\NombreNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NombreNote|null find($id, $lockMode = null, $lockVersion = null)
 * @method NombreNote|null findOneBy(array $criteria, array $orderBy = null)
 * @method NombreNote[]    findAll()
 * @method NombreNote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NombreNoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NombreNote::class);
    }

    // /**
    //  * @return NombreNote[] Returns an array of NombreNote objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NombreNote
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

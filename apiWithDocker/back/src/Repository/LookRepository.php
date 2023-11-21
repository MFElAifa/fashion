<?php

namespace App\Repository;

use App\Entity\Look;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Look>
 *
 * @method Look|null find($id, $lockMode = null, $lockVersion = null)
 * @method Look|null findOneBy(array $criteria, array $orderBy = null)
 * @method Look[]    findAll()
 * @method Look[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Look::class);
    }

//    /**
//     * @return Look[] Returns an array of Look objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Look
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

<?php

namespace App\Repository;

use App\Entity\Deliveryman;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends UserRepository<Deliveryman>
 *
 * @method Deliveryman|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deliveryman|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deliveryman[]    findAll()
 * @method Deliveryman[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeliverymanRepository extends UserRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry);
    }

//    /**
//     * @return Deliveryman[] Returns an array of Deliveryman objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Deliveryman
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

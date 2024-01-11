<?php

namespace App\Repository;

use App\Entity\Order;
use DatePeriod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 *
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function save(Order $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function delete(Order $cOrder)
    {
        $this->_em->remove($cOrder);
        $this->getEntityManager()->flush();
    }

    public function getWeeklyOrder(): array
    {
        $d = strtotime("today");

        $start_week = strtotime("last monday midnight",$d);
        $end_week = strtotime("next saturday",$d);

        $start = date("Y-m-d",$start_week);
        $end = date("Y-m-d",$end_week);

        $start = new \DateTime($start);
        $end = new \DateTime($end);

        $interval = new \DateInterval('P1D');
        $range = new DatePeriod($start, $interval, $end);

        $result = [];

        foreach ($range as $date) {

            $result[] = $this->createQueryBuilder('o')
                ->join('o.delivery', 'd')
                ->andWhere('d.date = :date_')
                ->setParameter('date_', $date->format('Y-m-d'))
                ->getQuery()
                ->getResult();
        }

        return $result;
    }
}

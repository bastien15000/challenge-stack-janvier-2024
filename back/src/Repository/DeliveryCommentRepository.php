<?php

namespace App\Repository;

use App\Entity\DeliveryComment;
use DatePeriod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DeliveryComment>
 *
 * @method DeliveryComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeliveryComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeliveryComment[]    findAll()
 * @method DeliveryComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeliveryCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeliveryComment::class);
    }

    public function save(DeliveryComment $deliveryComment, bool $flush = false): void
    {
        $this->getEntityManager()->persist($deliveryComment);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function delete(DeliveryComment $cDeliveryComment)
    {
        $this->_em->remove($cDeliveryComment);
        $this->getEntityManager()->flush();
    }

    public function getWeeklyDeliveryComment(): array
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

            $result[] = $this->createQueryBuilder('dc')
                ->join('dc.delivery', 'd')
                ->andWhere('d.date = :date_')
                ->setParameter('date_', $date->format('Y-m-d'))
                ->getQuery()
                ->getResult();
        }

        return $result;
    }
}

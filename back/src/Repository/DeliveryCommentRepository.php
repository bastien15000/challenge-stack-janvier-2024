<?php

namespace App\Repository;

use App\Entity\DeliveryComment;
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
}

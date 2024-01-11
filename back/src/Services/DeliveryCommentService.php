<?php

namespace App\Services;

use App\Entity\DeliveryComment;
use App\Repository\DeliveryCommentRepository;
use App\Repository\DeliveryRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeliveryCommentService {

    public function __construct (
        private readonly DeliveryCommentRepository $deliveryCommentRepository,
        private readonly DeliveryRepository $deliveryRepository
    ) {}

    public function getDeliveryComments(): array
    {
        return $this->deliveryCommentRepository->findAll();
    }

    public function getDeliveryComment(string $id): ?DeliveryComment
    {
        return $this->deliveryCommentRepository->findOneBy(['id' => $id]);
    }

    public function createDeliveryComment(DeliveryComment $newDeliveryComment): void
    {
        if ($this->getDeliveryComment($newDeliveryComment->getId())){
            throw new ConflictHttpException('Le retour de livraison existe déjà');
        }

        $this->deliveryCommentRepository->save($newDeliveryComment, true);
    }

    public function updateOrCreateDeliveryComment(DeliveryComment $deliveryComment, string $id): void
    {
        $cDeliveryComment = $this->getDeliveryComment($id);

        if (is_null($cDeliveryComment)) {
            $this->createDeliveryComment($deliveryComment);
        } else {
            $cDeliveryComment->setKmStart($deliveryComment->getKmStart())
                ->setKmEnd($deliveryComment->getKmEnd())
                ->setFuelBill($deliveryComment->getFuelBill())
                ->setTollRate($deliveryComment->getTollRate())
                ->setComment($deliveryComment->getComment())
                ->setDelivery($deliveryComment->getDelivery());

            $this->deliveryCommentRepository->save($cDeliveryComment, true);
        }
    }

    public function deleteDeliveryComment(string $id) : DeliveryComment
    {
        $cDeliveryComment = $this->getDeliveryComment($id);

        if (is_null($cDeliveryComment)) {
            throw new NotFoundHttpException('Aucun retour de livraison trouvé');
        } else {
            $this->deliveryCommentRepository->delete($cDeliveryComment);
        }

        return $cDeliveryComment;
    }

    public function updateDeliveryComment(mixed $deliveryComment_informations, string $id): DeliveryComment
    {
        $cDeliveryComment = $this->getDeliveryComment($id);

        if (is_null($cDeliveryComment)) {
            throw new NotFoundHttpException('Aucun retour de livraison trouvé');
        } else {

            $invalid = true;

            if (property_exists($deliveryComment_informations, 'kmStart')) {
                $cDeliveryComment->setKmStart($deliveryComment_informations->kmStart);
                $invalid = false;
            }
            if (property_exists($deliveryComment_informations, 'kmEnd')) {
                $cDeliveryComment->setKmEnd($deliveryComment_informations->kmEnd);
                $invalid = false;
            }
            if (property_exists($deliveryComment_informations, 'fuelBill')) {
                $cDeliveryComment->setFuelBill($deliveryComment_informations->fuelBill);
                $invalid = false;
            }
            if (property_exists($deliveryComment_informations, 'tollRate')) {
                $cDeliveryComment->setTollRate($deliveryComment_informations->tollRate);
                $invalid = false;
            }
            if (property_exists($deliveryComment_informations, 'comment')) {
                $cDeliveryComment->setComment($deliveryComment_informations->comment);
                $invalid = false;
            }
            if (property_exists($deliveryComment_informations, 'delivery')) {
                $delivery = $this->deliveryRepository->findOneBy(['id' => $deliveryComment_informations->delivery]);
                $cDeliveryComment->setDelivery($delivery);
                $invalid = false;
            }

            if ($invalid) throw new BadRequestException('Format invalide');

            $this->deliveryCommentRepository->save($cDeliveryComment, true);
        }

        return $cDeliveryComment;
    }
}
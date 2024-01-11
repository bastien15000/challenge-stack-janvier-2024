<?php

namespace App\Services;

use App\Entity\Delivery;
use App\Repository\DeliveryRepository;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeliveryService {

    public function __construct (
        private readonly DeliveryRepository $deliveryRepository,
        private readonly OrderRepository $orderRepository
    ) {}

    public function getDeliveries(): array
    {
        return $this->deliveryRepository->findAll();
    }

    public function getDelivery(string $id): ?Delivery
    {
        return $this->deliveryRepository->findOneBy(['id' => $id]);
    }

    public function createDelivery(Delivery $newDelivery): void
    {
        if ($this->getDelivery($newDelivery->getId())){
            throw new ConflictHttpException('La commande existe déjà');
        }

        $this->deliveryRepository->save($newDelivery, true);
    }

    public function updateOrCreateDelivery(Delivery $delivery, string $id): void
    {
        $cDelivery = $this->getDelivery($id);

        if (is_null($cDelivery)) {
            $this->createDelivery($delivery);
        } else {
            $cDelivery->setDeliveryman($delivery->getDeliveryman())
                ->setDate($delivery->getDate())
                ->setDeliveryComment($delivery->getDeliveryComment());

            $cDelivery->resetOrders();

            foreach ($delivery->getOrders() as $orderId) {
                $order = $this->orderRepository->findOneBy(['id' => $orderId]);
                $cDelivery->addOrder($order);
            }

            $this->deliveryRepository->save($cDelivery, true);
        }
    }

    public function deleteDelivery(string $id) : Delivery
    {
        $cDelivery = $this->getDelivery($id);

        if (is_null($cDelivery)) {
            throw new NotFoundHttpException('Aucune livraison trouvée');
        } else {
            $this->deliveryRepository->delete($cDelivery);
        }

        return $cDelivery;
    }

    public function updateDelivery(mixed $delivery_informations, string $id): Delivery
    {
        $cDelivery = $this->getDelivery($id);

        if (is_null($cDelivery)) {
            throw new NotFoundHttpException('Aucune livraison trouvée');
        } else {

            $invalid = true;

            if (property_exists($delivery_informations, 'deliveryman')) {
                $cDelivery->setDeliveryman($delivery_informations->deliveryman);
                    $invalid = false;
            }
            if (property_exists($delivery_informations, 'date')) {
                $cDelivery->setDate($delivery_informations->date);
                $invalid = false;
            }
            if (property_exists($delivery_informations, 'deliveryComment')) {
                $cDelivery->setDeliveryComment($delivery_informations->deliveryComment);
                $invalid = false;
            }
            if (property_exists($delivery_informations, 'orders')) {
                $cDelivery->resetOrders();

                foreach ($delivery_informations->orders as $orderId) {
                    $order = $this->orderRepository->findOneBy(['id' => $orderId]);
                    $cDelivery->addOrder($order);
                }
                $invalid = false;
            }

            if ($invalid) throw new BadRequestException('Format invalide');

            $this->deliveryRepository->save($cDelivery, true);
        }

        return $cDelivery;
    }

    public function getDeliveryByDeliveryMan(string $id): Delivery
    {
        return $this->deliveryRepository->findOneBy(['deliveryman' => $id]);
    }
}
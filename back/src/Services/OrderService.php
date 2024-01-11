<?php

namespace App\Services;

use App\Entity\Order;
use App\Entity\State;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderService {

    public function __construct (
        private readonly OrderRepository $orderRepository,
        private readonly FeedbackService $feedbackService,
        private readonly DeliveryService $deliveryService,
        private readonly CustomerService $customerService
    ) {}

    public function getOrders(): array
    {
        return $this->orderRepository->findAll();
    }

    public function getOrder(string $id): ?Order
    {
        return $this->orderRepository->findOneBy(['id' => $id]);
    }

    public function createOrder(Order $newOrder): void
    {
        if ($this->getOrder($newOrder->getId())){
            throw new ConflictHttpException('La commande existe déjà');
        }

        $this->orderRepository->save($newOrder, true);
    }

    public function updateOrCreateOrder(Order $order, string $id): void
    {
        $cOrder = $this->getOrder($id);

        if (is_null($cOrder)) {
            $this->createOrder($order);
        } else {
            $cOrder->setState($order->getState())
                ->setComment($order->getComment())
                ->setStartTime($order->getStartTime())
                ->setEndTime($order->getEndTime())
                ->setExpectedTime($order->getExpectedTime())
                ->setDelivery($order->getDelivery())
                ->setFeedback($order->getFeedback())
                ->setQuantity($order->getQuantity())
                ->setCustomer($order->getCustomer());

            $this->orderRepository->save($cOrder, true);
        }
    }

    public function deleteOrder(string $id) : Order
    {
        $cOrder = $this->getOrder($id);

        if (is_null($cOrder)) {
            throw new NotFoundHttpException('Aucune commande trouvée');
        } else {
            $this->orderRepository->delete($cOrder);
        }

        return $cOrder;
    }

    public function updateOrder(mixed $order_informations, string $id): Order
    {
        $cOrder = $this->getOrder($id);

        if (is_null($cOrder)) {
            throw new NotFoundHttpException('Aucune commande trouvée');
        } else {

            $invalid = true;

            if (property_exists($order_informations, 'state') && $order_informations->state instanceof State) {
                $cOrder->setState($order_informations->state);
                $invalid = false;
            }
            if (property_exists($order_informations, 'comment')) {
                $cOrder->setComment($order_informations->comment);
                $invalid = false;
            }
            if (property_exists($order_informations, 'startTime')) {
                $cOrder->setStartTime($order_informations->startTime);
            }
            if (property_exists($order_informations, 'endTime')) {
                $cOrder->setEndTime($order_informations->endTime);
                $invalid = false;
            }
            if (property_exists($order_informations, 'expectedTime')) {
                $cOrder->setExpectedTime($order_informations->expectedTime);
                $invalid = false;
            }
            if (property_exists($order_informations, 'delivery')) {
                $delivery = $this->deliveryService->getDelivery($order_informations->delivery);
                $cOrder->setDelivery($delivery);
                $invalid = false;
            }
            if (property_exists($order_informations, 'feedback')) {
                $feedback = $this->feedbackService->getFeedback($order_informations->feedback);
                $cOrder->setFeedback($feedback);
                $invalid = false;
            }
            if (property_exists($order_informations, 'quantity')) {
                $cOrder->setQuantity($order_informations->quantity);
                $invalid = false;
            }
            if (property_exists($order_informations, 'customer')) {
                $customer = $this->customerService->getCustomer($order_informations->customer);
                $cOrder->setCustomer($customer);
                $invalid = false;
            }

            if ($invalid) throw new BadRequestException('Format invalide');

            $this->orderRepository->save($cOrder, true);
        }

        return $cOrder;
    }
}
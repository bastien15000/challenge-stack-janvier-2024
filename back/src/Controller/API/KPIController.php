<?php

namespace App\Controller\API;

use App\DTO\IPL;
use App\DTO\ServiceRate;
use App\Enum\OrderState;
use App\Repository\DeliveryCommentRepository;
use App\Repository\OrderRepository;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/kpi', name: 'api_kpi')]
class KPIController extends APIController
{

    public function __construct(
        private readonly DeliveryCommentRepository $deliveryCommentRepository,
        private readonly OrderRepository $orderRepository
    ) {}

    #[Route('/ipl', name: '_ipl', methods: 'GET')]
    public function getIPL() {
        $deliveryCommentsPerDays = $this->deliveryCommentRepository->getWeeklyDeliveryComment();

        $ipl = new IPL();
        $nbDC = 0;
        $dailyCost = [];
        $i = 0;

        foreach ($deliveryCommentsPerDays as $deliveryCommentsDay) {

            foreach ($deliveryCommentsDay as $deliveryComment) {
                $nbDC++;
                $dailyCost[$i] += $deliveryComment->getTollRate() + $deliveryComment->getFuelBill();
                $ipl->setAverageDeliveryCost($ipl->getAverageDeliveryCost() + $deliveryComment->getTollRate() + $deliveryComment->getFuelBill());
            }

            $dailyCost[$i] = $dailyCost[$i] / sizeof($deliveryCommentsDay);
            $i++;
        }

        $ipl->setAverageDeliveryCost($ipl->getAverageDeliveryCost() / $nbDC);
    }

    #[Route('/serviceRate', name: '_service_rate', methods: 'GET')]
    public function getServiceRate() {

        try {
            $ordersPerDay = $this->orderRepository->getWeeklyOrder();
            $serviceRate = new ServiceRate();

            $nbTotal = 0;
            $nbDelivered = 0;
            $perDay = [];

            foreach ($ordersPerDay as $ordersDay) {

                $nbTotalDay = 0;
                $nbDeliveredDay = 0;

                foreach ($ordersDay as $order) {
                    $nbTotal++;
                    $nbTotalDay++;

                    if ($order->getState() == OrderState::Delivered) {
                        $nbDelivered++;
                        $nbDeliveredDay++;
                    }
                }

                $perDay[] = ($nbDeliveredDay * 100) / $nbTotalDay;
            }

            $serviceRate->setOrdersTotal($nbTotal);
            $serviceRate->setOrdersDelivered($nbDelivered);
            $serviceRate->setRate(($nbDelivered * 100) / $nbTotal);
            $serviceRate->setPerDays($perDay);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $serviceRate
        ]);
    }
}
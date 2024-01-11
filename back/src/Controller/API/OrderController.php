<?php

namespace App\Controller\API;

use App\Entity\Order;
use App\Services\OrderService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/orders', name: 'api_orders')]
class OrderController extends APIController
{

    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly OrderService $orderService
    ) {
    }

    #[Route('', name: '_all', methods: 'GET')]
    public function getOrders(Request $request): JsonResponse
    {

        try {
            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $orders = $this->orderService->getOrders();
        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $orders
        ], 200, [], [
            'groups' => 'list_deliveries'
        ]);
    }

    #[Route('/{id}', name: '_byId', methods: 'GET')]
    public function getOrderById(Request $request, string $id): JsonResponse
    {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $order = $this->orderService->getOrder($id);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $order
        ]);
    }

    #[Route('', name: '_create', methods: 'POST')]
    public function createOrderById(Request $request): JsonResponse
    {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $newOrder = $request->getContent();
            $newOrder = $this->serializer->deserialize($newOrder, Order::class, 'json');
            $this->verifyForm($newOrder);

            $this->orderService->createOrder($newOrder);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 201,
            'content' => $newOrder
        ], 201);
    }

    #[Route('/{id}', name: '_update_create', methods: 'PUT')]
    public function updateOrCreateOrderById(Request $request, string $id): JsonResponse
    {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $order = $request->getContent();
            $order = $this->serializer->deserialize($order, Order::class, 'json');
            $this->verifyForm($order);

            $this->orderService->updateOrCreateOrder($order, $id);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $order
        ]);
    }

    #[Route('/{id}', name: '_delete', methods: 'DELETE')]
    public function deleteOrderById(Request $request, string $id): JsonResponse
    {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $order = $this->orderService->deleteOrder($id);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $order
        ]);
    }

    #[Route('/{id}', name: '_update', methods: 'PATCH')]
    public function updateOrderById(Request $request, string $id): JsonResponse
    {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $order_informations = json_decode($request->getContent());

            $order = $this->orderService->updateOrder($order_informations, $id);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $order
        ]);
    }
}

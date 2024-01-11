<?php

namespace App\Controller\API;

use App\Entity\Delivery;
use App\Services\DeliveryService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DeliveryController extends APIController
{
    public function __construct (
        private readonly SerializerInterface $serializer,
        private readonly DeliveryService $deliveryService
    ) {}

    #[Route('', name: '_all', methods: 'GET')]
    public function getDeliveries(Request $request): JsonResponse {

        try {
            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $deliverys = $this->deliveryService->getDeliveries();
        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $deliverys
        ]);
    }

    #[Route('/{id}', name: '_byId', methods: 'GET')]
    public function getDeliveryById(Request $request, string $id): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $delivery = $this->deliveryService->getDelivery($id);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $delivery
        ]);
    }

    #[Route('/deliveryman/{id}', name: '_byDeliveryMan', methods: 'GET')]
    public function getDeliveryBydeliveryMan(Request $request, string $id): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $delivery = $this->deliveryService->getDeliveryByDeliveryMan($id);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $delivery
        ]);
    }

    #[Route('', name: '_create', methods: 'POST')]
    public function createDeliveryById(Request $request): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $newDelivery = $request->getContent();
            $newDelivery = $this->serializer->deserialize($newDelivery, Delivery::class, 'json');
            $this->verifyForm($newDelivery);

            $this->deliveryService->createDelivery($newDelivery);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 201,
            'content' => $newDelivery
        ], 201);
    }

    #[Route('/{id}', name: '_update_create', methods: 'PUT')]
    public function updateOrCreateDeliveryById(Request $request, string $id): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $delivery = $request->getContent();
            $delivery = $this->serializer->deserialize($delivery, Delivery::class, 'json');
            $this->verifyForm($delivery);

            $this->deliveryService->updateOrCreateDelivery($delivery, $id);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $delivery
        ]);
    }

    #[Route('/{id}', name: '_delete', methods: 'DELETE')]
    public function deleteDeliveryById(Request $request, string $id): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $delivery = $this->deliveryService->deleteDelivery($id);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $delivery
        ]);
    }

    #[Route('/{id}', name: '_update', methods: 'PATCH')]
    public function updateDeliveryById(Request $request, string $id): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $delivery_informations = json_decode($request->getContent());

            $delivery = $this->deliveryService->updateDelivery($delivery_informations, $id);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $delivery
        ]);
    }
}
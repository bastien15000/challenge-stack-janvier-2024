<?php

namespace App\Controller\API;

use App\Entity\DeliveryComment;
use App\Services\DeliveryCommentService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/deliveryComments', name: 'api_deliveryComments')]
class DeliveryCommentController extends APIController
{

    public function __construct (
        private readonly SerializerInterface $serializer,
        private readonly DeliveryCommentService $deliveryCommentService
    ) {}

    #[Route('', name: '_all', methods: 'GET')]
    public function getDeliveryComments(Request $request): JsonResponse {

        try {
            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $deliveryComments = $this->deliveryCommentService->getDeliveryComments();
        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $deliveryComments
        ]);
    }

    #[Route('/{id}', name: '_byId', methods: 'GET')]
    public function getDeliveryCommentById(Request $request, string $id): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $deliveryComment = $this->deliveryCommentService->getDeliveryComment($id);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $deliveryComment
        ]);
    }

    #[Route('', name: '_create', methods: 'POST')]
    public function createDeliveryCommentById(Request $request): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $newDeliveryComment = $request->getContent();
            $newDeliveryComment = $this->serializer->deserialize($newDeliveryComment, DeliveryComment::class, 'json');
            $this->verifyForm($newDeliveryComment);

            $this->deliveryCommentService->createDeliveryComment($newDeliveryComment);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 201,
            'content' => $newDeliveryComment
        ], 201);
    }

    #[Route('/{id}', name: '_update_create', methods: 'PUT')]
    public function updateOrCreateDeliveryCommentById(Request $request, string $id): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $deliveryComment = $request->getContent();
            $deliveryComment = $this->serializer->deserialize($deliveryComment, DeliveryComment::class, 'json');
            $this->verifyForm($deliveryComment);

            $this->deliveryCommentService->updateOrCreateDeliveryComment($deliveryComment, $id);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $deliveryComment
        ]);
    }

    #[Route('/{id}', name: '_delete', methods: 'DELETE')]
    public function deleteDeliveryCommentById(Request $request, string $id): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $deliveryComment = $this->deliveryCommentService->deleteDeliveryComment($id);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $deliveryComment
        ]);
    }

    #[Route('/{id}', name: '_update', methods: 'PATCH')]
    public function updateDeliveryCommentById(Request $request, string $id): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $deliveryComment_informations = json_decode($request->getContent());

            $deliveryComment = $this->deliveryCommentService->updateDeliveryComment($deliveryComment_informations, $id);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $deliveryComment
        ]);
    }
}
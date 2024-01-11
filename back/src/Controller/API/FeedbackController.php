<?php

namespace App\Controller\API;

use App\Entity\Feedback;
use App\Services\FeedbackService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/feedbacks', name: 'api_feedbacks')]
class FeedbackController extends APIController {

    public function __construct (
        private readonly SerializerInterface $serializer,
        private readonly FeedbackService $feedbackService
    ) {}

    #[Route('', name: '_all', methods: 'GET')]
    public function getFeedbacks(Request $request): JsonResponse {

        try {
            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $feedbacks = $this->feedbackService->getFeedbacks();
        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $feedbacks
        ]);
    }

    #[Route('/{id}', name: '_byId', methods: 'GET')]
    public function getFeedbackById(Request $request, string $id): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $feedback = $this->feedbackService->getFeedback($id);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $feedback
        ]);
    }

    #[Route('', name: '_create', methods: 'POST')]
    public function createFeedbackById(Request $request): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $newFeedback = $request->getContent();
            $newFeedback = $this->serializer->deserialize($newFeedback, Feedback::class, 'json');
            $this->verifyForm($newFeedback);

            $this->feedbackService->createFeedback($newFeedback);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 201,
            'content' => $newFeedback
        ], 201);
    }

    #[Route('/{id}', name: '_update_create', methods: 'PUT')]
    public function updateOrCreateFeedbackById(Request $request, string $id): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $feedback = $request->getContent();
            $feedback = $this->serializer->deserialize($feedback, Feedback::class, 'json');
            $this->verifyForm($feedback);

            $this->feedbackService->updateOrCreateFeedback($feedback, $id);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $feedback
        ]);
    }

    #[Route('/{id}', name: '_delete', methods: 'DELETE')]
    public function deleteFeedbackById(Request $request, string $id): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $feedback = $this->feedbackService->deleteFeedback($id);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $feedback
        ]);
    }

    #[Route('/{id}', name: '_update', methods: 'PATCH')]
    public function updateFeedbackById(Request $request, string $id): JsonResponse {

        try {

            $contentType = $request->headers->get('Content-type');
            $this->verifyFormatAllowed($contentType);

            $feedback_informations = json_decode($request->getContent());

            $feedback = $this->feedbackService->updateFeedback($feedback_informations, $id);

        } catch (\Exception $e) {
            return $this->handleException($e);
        }

        return $this->json([
            'status' => 200,
            'content' => $feedback
        ]);
    }
}
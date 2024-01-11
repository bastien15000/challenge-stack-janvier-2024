<?php

namespace App\Services;

use App\Entity\Feedback;
use App\Repository\FeedbackRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FeedbackService {

    public function __construct (
        private readonly FeedbackRepository $feedbackRepository
    ) {}

    public function getFeedbacks(): array
    {
        return $this->feedbackRepository->findAll();
    }

    public function getFeedback(string $id): ?Feedback
    {
        return $this->feedbackRepository->findOneBy(['id' => $id]);
    }

    public function createFeedback(Feedback $newFeedback): void
    {
        if ($this->getFeedback($newFeedback->getId())){
            throw new ConflictHttpException('Le feedback existe déjà');
        }

        $this->feedbackRepository->save($newFeedback, true);
    }

    public function updateOrCreateFeedback(Feedback $feedback, string $id): void
    {
        $cFeedback = $this->getFeedback($id);

        if (is_null($cFeedback)) {
            $this->createFeedback($feedback);
        } else {
            $cFeedback->setComment($feedback->getComment())
                ->setBrokenItems($feedback->getBrokenItems())
                ->setDeliverymanMark($feedback->getDeliverymanMark())
                ->setFullfilled($feedback->isFullfilled())
                ->setLate($feedback->isLate())
                ->setMark($feedback->getMark())
                ->setOrder($feedback->getOrder());

            $this->feedbackRepository->save($cFeedback, true);
        }
    }

    public function deleteFeedback(string $id) : Feedback
    {
        $cFeedback = $this->getFeedback($id);

        if (is_null($cFeedback)) {
            throw new NotFoundHttpException('Aucun feedback trouvé');
        } else {
            $this->feedbackRepository->delete($cFeedback);
        }

        return $cFeedback;
    }

    public function updateFeedback(mixed $feedback_informations, string $id): Feedback
    {
        $cFeedback = $this->getFeedback($id);

        if (is_null($cFeedback)) {
            throw new NotFoundHttpException('Aucun feedback trouvé');
        } else {

            $invalid = true;

            if (property_exists($feedback_informations, 'comment')) {
                $cFeedback->setComment($feedback_informations->comment);
                    $invalid = false;
            }
            if (property_exists($feedback_informations, 'brokenItems')) {
                $cFeedback->setBrokenItems($feedback_informations->brokenItems);
                $invalid = false;
            }
            if (property_exists($feedback_informations, 'deliverymanMark')) {
                $cFeedback->setDeliverymanMark($feedback_informations->deliverymanMark);
                $invalid = false;
            }
            if (property_exists($feedback_informations, 'isFullfilled')) {
                $cFeedback->setFullfilled($feedback_informations->isFullfilled);
                $invalid = false;
            }
            if (property_exists($feedback_informations, 'isLate')) {
                $cFeedback->setLate($feedback_informations->isLate);
                $invalid = false;
            }
            if (property_exists($feedback_informations, 'mark')) {
                $cFeedback->setMark($feedback_informations->mark);
                $invalid = false;
            }
            if (property_exists($feedback_informations, 'order')) {
                $cFeedback->setOrder($feedback_informations->order);
                $invalid = false;
            }

            if ($invalid) throw new BadRequestException('Format invalide');

            $this->feedbackRepository->save($cFeedback, true);
        }

        return $cFeedback;
    }
}
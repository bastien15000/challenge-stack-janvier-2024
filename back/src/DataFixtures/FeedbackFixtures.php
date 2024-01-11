<?php

namespace App\DataFixtures;

use App\Entity\Feedback;
use App\Entity\Order;
use App\Enum\OrderState;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FeedbackFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Création de 50 feedbacks
        for ($i = 1; $i <= 50; $i++) {
            $orderDelivered = $this->getReference("orderDelivered{$i}");

            $feedback = $this->createFeedback($orderDelivered);
            $manager->persist($feedback);
        }

        $manager->flush();
    }

    private function createFeedback($order): Feedback
    {
        $feedback = new Feedback();
        $feedback
            ->setMark(mt_rand(1, 10))
            ->setBrokenItems(mt_rand(0, 100))
            ->setFullfilled(true)
            ->setDeliverymanMark(mt_rand(1, 10))
            ->setLate(false)
            ->setOrder($order)
            ->setComment("Commentaire du feedback");

        return $feedback;
    }

    public function getDependencies(): array
    {
        return [
            OrderFixtures::class,
        ];
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\DeliveryComment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DeliveryCommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Création de 10 commentaires de livraison
        for ($i = 1; $i <= 10; $i++) {
            $mondayDelivery = $this->getReference("mondayDelivery{$i}");

            $deliveryComment = $this->createDeliveryComment($mondayDelivery);
            $manager->persist($deliveryComment);
        }

        $manager->flush();
    }

    private function createDeliveryComment($delivery): DeliveryComment
    {
        $deliveryComment = new DeliveryComment();
        $deliveryComment
            ->setDelivery($delivery)
            ->setKmStart(mt_rand(1000, 100000))
            ->setKmEnd(mt_rand(2000, 150000))
            ->setTollRate(mt_rand(5, 50))
            ->setFuelBill(mt_rand(30, 100))
            ->setComment("Commentaire de livraison");

        return $deliveryComment;
    }

    public function getDependencies(): array
    {
        return [
            DeliveryFixtures::class,
        ];
    }
}

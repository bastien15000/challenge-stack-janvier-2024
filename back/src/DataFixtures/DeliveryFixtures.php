<?php

namespace App\DataFixtures;

use App\Entity\Delivery;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DeliveryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Création de 5 livraisons par livreur
        $nb_delivery = 1;
        for ($i = 1; $i <= 10; $i++) {
            $deliveryman = $this->getReference("deliveryman{$i}");

            for ($j = 0; $j < 5; $j++) {
                $date = new \DateTime("now +{$j} day");

                $delivery = $this->createDelivery($deliveryman, $date);
                $manager->persist($delivery);

                $this->addReference("delivery{$nb_delivery}", $delivery);
                $nb_delivery++;
            }
        }

        $manager->flush();
    }

    private function createDelivery($deliveryman, $date): Delivery
    {
        $delivery = new Delivery();
        $delivery
            ->setDeliveryman($deliveryman)
            ->setDate($date);

        return $delivery;
    }

    public function getDependencies(): array
    {
        return [
            DeliverymanFixtures::class,
        ];
    }
}

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
        $nbDelivery = 1;
        $nbMondayDelivery = 1;
        for ($i = 1; $i <= 10; $i++) {
            $deliveryman = $this->getReference("deliveryman{$i}");

            for ($j = 0; $j < 5; $j++) {
                $date = new \DateTime("2024-01-09 +{$j} day");

                $delivery = $this->createDelivery($deliveryman, $date);
                $manager->persist($delivery);

                $this->addReference("delivery{$nbDelivery}", $delivery);
                $nbDelivery++;

            }

            // Création de la journée de livraison du lundi 08/01 pour chaque livreur
            $mondayDelivery = $this->createMondayDelivery($deliveryman);
            $manager->persist($mondayDelivery);

            $this->addReference("mondayDelivery{$nbMondayDelivery}", $mondayDelivery);

            $nbMondayDelivery++;
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

    private function createMondayDelivery($deliveryman): Delivery
    {
        $delivery = new Delivery();
        $delivery
            ->setDeliveryman($deliveryman)
            ->setDate(new \DateTime("2024-01-08"));

        return $delivery;
    }

    public function getDependencies(): array
    {
        return [
            DeliverymanFixtures::class,
        ];
    }
}

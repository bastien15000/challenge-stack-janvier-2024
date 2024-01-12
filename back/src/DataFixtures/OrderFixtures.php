<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Enum\OrderState;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Création de 5 commandes par journée de livraison, par livreur
        $nbOrder = 1;
        for ($i = 1; $i <= 5; $i++) {
            for ($j = 1; $j <= 10; $j++) {
                for ($k = 1; $k <= 5; $k++) {
                    $moduloCustomer = $nbOrder % 30 + 1;
                    $customer = $this->getReference("customer{$moduloCustomer}");

                    $moduloDelivery = $nbOrder % 50 + 1;
                    $delivery = $this->getReference("delivery{$moduloDelivery}");

                    $order = $this->createOrder($customer, $delivery);

                    $manager->persist($order);

                    $nbOrder++;
                }
            }
        }

        // Création de 5 commandes par lundi de livraison, par livreur
        $nbOrderDelivered = 1;
        for ($ii = 1; $ii <= 10; $ii++) {
            $mondayDelivery = $this->getReference("mondayDelivery{$ii}");

            for ($jj = 1; $jj <= 5; $jj++) {
                $moduloCustomer = $nbOrderDelivered % 30 + 1;
                $customer = $this->getReference("customer{$moduloCustomer}");
                $orderDelivered = $this->createOrderDelivered($customer, $mondayDelivery);

                $manager->persist($orderDelivered);

                $this->addReference("orderDelivered{$nbOrderDelivered}", $orderDelivered);

                $nbOrderDelivered++;
            }
        }

        $manager->flush();
    }

    private function createOrder($customer, $delivery): Order
    {
        $deliveryDate = clone $delivery->getDate(); // Créer une copie pour éviter de modifier la date d'origine

        $startDate = clone $deliveryDate; // Créer une copie indépendante pour startDate
        $startDate->setTime(8, 0, 0); // Heure de début (08:00)

        $endDate = clone $deliveryDate; // Créer une copie indépendante pour endDate
        $endDate->setTime(18, 0, 0); // Heure de fin (18:00)

        $randomDate = mt_rand($startDate->getTimestamp(), $endDate->getTimestamp());
        $date = (new \DateTime())->setTimestamp($randomDate);

        $order = new Order();
        $order
            ->setQuantity(mt_rand(100, 10000))
            ->setState(OrderState::Incoming)
            ->setCustomer($customer)
            ->setDelivery($delivery)
            ->setComment("Commentaire de la commande")
            ->setExpectedTime($date)
            ->setStartTime(null) // La date de début est nulle par défaut
            ->setEndTime(null); // La date de fin est nulle par défaut

        return $order;
    }

    private function createOrderDelivered($customer, $delivery): Order
    {
        $startDate = new \DateTime('2024-01-08 08:00');
        $endDate = new \DateTime('2024-01-08 18:00');

        $randomDate = mt_rand($startDate->getTimestamp(), $endDate->getTimestamp());
        $date = (new \DateTime())->setTimestamp($randomDate);

        $order = new Order();
        $order
            ->setQuantity(mt_rand(100, 10000))
            ->setState(OrderState::Delivered)
            ->setCustomer($customer)
            ->setDelivery($delivery)
            ->setComment("Commentaire de la commande")
            ->setExpectedTime($date)
            ->setStartTime(null) // La date de début est nulle par défaut
            ->setEndTime(null); // La date de fin est nulle par défaut

        return $order;
    }

    public function getDependencies(): array
    {
        return [
            DeliveryFixtures::class,
        ];
    }
}

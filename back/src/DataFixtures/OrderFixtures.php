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
        // Création de 5 commandes par livraison, par livreur
        $nb_order = 1;
        for ($i = 1; $i <= 5; $i++) {
            for ($j = 1; $j <= 10; $j++) {
                for ($k = 1; $k <= 5; $k++) {
                    $modulo_customer = $nb_order % 30 + 1;
                    $customer = $this->getReference("customer{$modulo_customer}");

                    $modulo_delivery = $nb_order % 50 + 1;
                    $delivery = $this->getReference("delivery{$modulo_delivery}");

                    $order = $this->createOrder($customer, $delivery);
                    $nb_order++;
                    $manager->persist($order);
                }
            }
        }

        $manager->flush();
    }

    private function createOrder($customer, $delivery): Order
    {
        $startDate = new \DateTime('2024-01-09 08:00');
        $endDate = new \DateTime('2024-01-13 18:00');

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

    public function getDependencies(): array
    {
        return [
            DeliveryFixtures::class,
        ];
    }
}

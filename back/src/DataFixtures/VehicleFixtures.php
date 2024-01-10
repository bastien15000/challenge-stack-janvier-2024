<?php

namespace App\DataFixtures;

use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $brand = [
            'ISUZU',
            'Iveco',
            'Mercedes',
            'Volkswagen',
        ];

        $models = [
            'TROOPER COURT',
            'DAILY 35S12 Combi - V10 - 8PL',
            'VITO 111 CDI',
            'Crafter',
        ];

        // Création de 12 véhicules avec les 4 modèles
        for ($i = 1; $i <= 12; $i++) {
            $vehicle = $this->createVehicle($brand[$i % 4],$models[$i % 4], $i);
            $manager->persist($vehicle);

            $this->addReference("vehicle{$i}", $vehicle);

        }

        $manager->flush();
    }

    private function createVehicle(string $brand, string $model, int $index): Vehicle
    {
        $vehicle = new Vehicle();
        $vehicle
            ->setBrand($brand)
            ->setModel($model);


        return $vehicle;
    }
}

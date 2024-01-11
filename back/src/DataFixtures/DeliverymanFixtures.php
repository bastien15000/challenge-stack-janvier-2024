<?php

namespace App\DataFixtures;

use App\Entity\Deliveryman;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class DeliverymanFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création de 10 livreurs
        for ($i = 1; $i <= 10; $i++) {
            $deliveryman = $this->createDeliveryman($i);
            $manager->persist($deliveryman);

            $this->addReference("deliveryman{$i}", $deliveryman);
        }

        $manager->flush();
    }

    private function createDeliveryman(int $index): Deliveryman
    {
        $deliveryman = new Deliveryman();
        $deliveryman
            ->setEmail("deliveryman{$index}@example.com")
            ->setPassword($this->hasher->hashPassword($deliveryman, 'pass_1234'))
            ->setPhone($this->generateRandomPhoneNumber())
            ->setRoles(['ROLE_DELIVERYMAN'])
            ->setSalary(mt_rand(2000, 4000)) // Salaire aléatoire entre 2000 et 4000
            ->setAverageMark(mt_rand(1, 10)) // Note moyenne aléatoire entre 1 et 10
            ->setNbMarks(mt_rand(0, 50)) // Nombre de notes aléatoire entre 0 et 50
            ->setVehicle($this->getReference("vehicle{$index}"));

        return $deliveryman;
    }

    private function generateRandomPhoneNumber(): string
    {
        // Générer un numéro de téléphone factice pour l'exemple
        return '+1' . mt_rand(100, 999) . '-' . mt_rand(100, 999) . '-' . mt_rand(1000, 9999);
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            VehicleFixtures::class,
        ];
    }
}

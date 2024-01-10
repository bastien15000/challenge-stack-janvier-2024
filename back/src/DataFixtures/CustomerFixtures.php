<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CustomerFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création de 30 clients
        for ($i = 1; $i <= 30; $i++) {
            $customer = $this->createCustomer($i);
            $manager->persist($customer);

            $this->addReference("customer{$i}", $customer);
        }

        $manager->flush();
    }

    private function createCustomer(int $index): Customer
    {
        $customer = new Customer();
        $customer
            ->setEmail("customer{$index}@example.com")
            ->setPassword($this->hasher->hashPassword($customer, 'pass_1234'))
            ->setPhone($this->generateRandomPhoneNumber())
            ->setRoles(['ROLE_CUSTOMER'])
            ->setAddress("Address {$index}")
            ->setComplement("Complement {$index}")
            ->setCity("City {$index}")
            ->setZipcode(mt_rand(01000, 95900)); // Code postal aléatoire entre 01000 et 95900

        return $customer;
    }

    private function generateRandomPhoneNumber(): string
    {
        // Générer un numéro de téléphone factice pour l'exemple
        return '+1' . mt_rand(100, 999) . '-' . mt_rand(100, 999) . '-' . mt_rand(1000, 9999);
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        // Création de 5 utilisateurs avec le rôle "ROLE_MANAGER"
        for ($i = 1; $i <= 5; $i++) {
            $managerUser = $this->createManager("manager{$i}@example.com");
            $manager->persist($managerUser);
        }

        $manager->flush();
    }

    private function createManager(string $email): User
    {
        $user = new User();
        $user
            ->setEmail($email)
            ->setRoles(['ROLE_MANAGER'])
            ->setPassword($this->hasher->hashPassword($user, 'pass_1234'))
            ->setPhone($this->generateRandomPhoneNumber());

        return $user;
    }

    private function generateRandomPhoneNumber(): string
    {
        // Générer un numéro de téléphone factice pour l'exemple
        return '+1' . mt_rand(100, 999) . '-' . mt_rand(100, 999) . '-' . mt_rand(1000, 9999);
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $userPasswordHasherInterface;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail("admin@gmail.com");
        $admin->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $admin,
                "HasloAdmin123!"
            )
        );
        $admin->setRoles(["ROLE_ADMIN", "ROLE_USER"]);
        $manager->persist($admin);

        $test_1 = new User();
        $test_1->setEmail("test1@gmail.com");
        $test_1->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $test_1,
                "HasloTestowe123!"
            )
        );
        $test_1->setRoles(["ROLE_USER"]);
        $manager->persist($test_1);

        $manager->flush();

        $this->addReference("admin", $admin);
        $this->addReference("test_1", $test_1);
    }
}

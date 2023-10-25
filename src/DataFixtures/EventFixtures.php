<?php

namespace App\DataFixtures;

use App\Entity\Event;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        // TEST_1 USER TRIPS

        $trip1DateTime = new DateTime();
        $trip1DateTime->setDate(2020, 5, 1);
        $trip1 = new Event();
        $trip1->setName("Majorka");
        $trip1->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
        $trip1->setDate($trip1DateTime);
        $trip1->setImagePath("https://cdn.pixabay.com/photo/2017/02/26/14/31/beach-2100369_1280.jpg");
        $trip1->setCategory($this->getReference("planeTrip"));
        $trip1->setUser($this->getReference("test_1"));
        $manager->persist($trip1);

        $trip2DateTime = new DateTime();
        $trip2DateTime->setDate(2021, 7, 21);
        $trip2 = new Event();
        $trip2->setName("Rome");
        $trip2->setDescription("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.");
        $trip2->setDate($trip2DateTime);
        $trip2->setImagePath("https://cdn.pixabay.com/photo/2019/10/06/08/57/tiber-river-4529605_1280.jpg");
        $trip2->setCategory($this->getReference("carTrip"));
        $trip2->setUser($this->getReference("test_1"));
        $manager->persist($trip2);


        $trip3DateTime = new DateTime();
        $trip3DateTime->setDate(2022, 3, 15);
        $trip3 = new Event();
        $trip3->setName("Kabacki Forest");
        $trip3->setDescription("It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).");
        $trip3->setDate($trip3DateTime);
        $trip3->setImagePath("https://cdn.pixabay.com/photo/2017/11/25/22/26/moss-2977795_1280.jpg");
        $trip3->setCategory($this->getReference("bikeTrip"));
        $trip3->setUser($this->getReference("test_1"));
        $manager->persist($trip3);

        $trip4DateTime = new DateTime();
        $trip4DateTime->setDate(2023, 2, 11);
        $trip4 = new Event();
        $trip4->setName("Jastarnia Beach");
        $trip4->setDescription("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.");
        $trip4->setDate($trip4DateTime);
        $trip4->setImagePath("https://cdn.pixabay.com/photo/2021/03/17/12/01/sea-6102171_1280.jpg");
        $trip4->setCategory($this->getReference("walkingTrip"));
        $trip4->setUser($this->getReference("test_1"));
        $manager->persist($trip4);

        // ADMIN USER TRIPS

        $adminTrip1DateTime = new DateTime();
        $adminTrip1DateTime->setDate(2019, 1, 1);
        $adminTrip1 = new Event();
        $adminTrip1->setName("Florence");
        $adminTrip1->setDescription("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.");
        $adminTrip1->setDate($adminTrip1DateTime);
        $adminTrip1->setImagePath("https://cdn.pixabay.com/photo/2020/05/23/08/23/florence-5208579_1280.jpg");
        $adminTrip1->setCategory($this->getReference("planeTrip"));
        $adminTrip1->setUser($this->getReference("admin"));
        $manager->persist($adminTrip1);

        $adminTrip2DateTime = new DateTime();
        $adminTrip2DateTime->setDate(2018, 1, 1);
        $adminTrip2 = new Event();
        $adminTrip2->setName("Kazimierz Dolny");
        $adminTrip2->setDescription("It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).");
        $adminTrip2->setDate($adminTrip2DateTime);
        $adminTrip2->setImagePath("https://cdn.pixabay.com/photo/2020/01/14/16/22/tree-4765461_1280.jpg");
        $adminTrip2->setCategory($this->getReference("walkingTrip"));
        $adminTrip2->setUser($this->getReference("admin"));
        $manager->persist($adminTrip2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            CategoryFixtures::class
        ];
    }
}

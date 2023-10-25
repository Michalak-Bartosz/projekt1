<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $bikeTrip = new Category();
        $bikeTrip->setName("Bike Trip");
        $bikeTrip->setColor("#FFA852");
        $bikeTrip->setImagePath("https://cdn.pixabay.com/photo/2017/02/24/18/13/vintage-bike-2095827_1280.jpg");
        $manager->persist($bikeTrip);

        $planeTrip = new Category();
        $planeTrip->setName("Plane Trip");
        $planeTrip->setColor("#3DABFF");
        $planeTrip->setImagePath("https://cdn.pixabay.com/photo/2018/03/19/20/57/aircraft-3241229_1280.jpg");
        $manager->persist($planeTrip);

        $carTrip = new Category();
        $carTrip->setName("Car Trip");
        $carTrip->setColor("#FFFC36");
        $carTrip->setImagePath("https://cdn.pixabay.com/photo/2020/05/16/09/56/car-5176821_1280.jpg");
        $manager->persist($carTrip);

        $walkingTrip = new Category();
        $walkingTrip->setName("Walking Trip");
        $walkingTrip->setColor("#9AA0A6");
        $walkingTrip->setImagePath("https://cdn.pixabay.com/photo/2014/01/22/19/38/boot-250012_1280.jpg");
        $manager->persist($walkingTrip);
        
        $manager->flush();

        $this->addReference("bikeTrip", $bikeTrip);
        $this->addReference("planeTrip", $planeTrip);
        $this->addReference("carTrip", $carTrip);
        $this->addReference("walkingTrip", $walkingTrip);
    }
}

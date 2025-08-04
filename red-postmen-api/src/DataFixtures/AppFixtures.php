<?php

namespace App\DataFixtures;

use App\Entity\Area;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $areaSamyHouse = new Area();
        $areaSamyHouse->setLabel('Samy house');
        $areaSamyHouse->setDescription('The house of comrade Samy');
        $areaSamyHouse->setDelimitation([
            ['lat' => '66.53947037556995', 'lng' => '25.799660400712764'],
        ]);
        $manager->persist($areaSamyHouse);

        $areaFredHouse = new Area();
        $areaFredHouse->setLabel('Fred house');
        $areaFredHouse->setDescription('The house of socdem Fred');
        $areaFredHouse->setDelimitation([
            ['lat' => '52.40511034929882', 'lng' => '13.034630267668984'],
            ['lat' => '52.40510256547481', 'lng' => '13.040231384388782'],
            ['lat' => '52.40002721983073', 'lng' => '13.042846940032423'],
            ['lat' => '52.399528994928104', 'lng' => '13.033762668723774'],
        ]);
        $manager->persist($areaFredHouse);

        $manager->flush();
    }
}
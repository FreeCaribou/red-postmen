<?php

namespace App\DataFixtures;

use App\Entity\Area;
use App\Entity\User;
use App\Entity\Postman;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

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

        $userSamy = new User();
        $userSamy->setEmail('samy@caribou.eu');
        $userSamy->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword($userSamy, 'plainpassword');
        $userSamy->setPassword($hashedPassword);
        $manager->persist($userSamy);

        $postmanRosa = new Postman();
        $postmanRosa->setName('Rosa');
        $postmanRosa->setCity('Berlin');
        $manager->persist($postmanRosa);

        $userSamy->addPostman($postmanRosa);
        $postmanRosa->addArea($areaSamyHouse);
        $postmanRosa->addArea($areaFredHouse);

        $postmanTito = new Postman();
        $postmanTito->setName('Tito');
        $postmanTito->setCity('Balkan');
        $manager->persist($postmanTito);

        $areaPartyHouse = new Area();
        $areaPartyHouse->setLabel('Party house');
        $areaPartyHouse->setDescription('The house to make parties');
        $areaPartyHouse->setDelimitation([
            ['lat' => '50.84175266545542', 'lng' => '4.342489799923105'],
        ]);
        $manager->persist($areaPartyHouse);

        $postmanRaoul = new Postman();
        $postmanRaoul->setName('Raoul');
        $postmanRaoul->setCity('Brussels');
        $postmanRaoul->addArea($areaPartyHouse);
        $manager->persist($postmanRaoul);

        $manager->flush();
    }
}

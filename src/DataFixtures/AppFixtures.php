<?php

namespace App\DataFixtures;

use App\Entity\Aircraft;
use App\Entity\AircraftModel;
use App\Entity\AirCrew;
use App\Entity\Airport;
use App\Entity\Flight;
use App\Entity\Pilot;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
       $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // Users
        $user = new User();
        $user->setSurname("Tambiradja")
            ->setFirstname("Edouard-Louis")
            ->setAddress("39bis rue sergent michel Berthet, 69009 Lyon")
            ->setEmail("edouard.tambi@gmail.com")
            ->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'mypassword'));

        $manager->persist($user);


        // Aircraft model
        $model = new AircraftModel();
        $model->setCapacity(180)
            ->setName("A320")
            ->setPiloting(2);

        $manager->persist($model);


        // Aircrafts
        $aircraft1 = new Aircraft();
        $aircraft1->setModel($model)
            ->setRegistrationNumber("123456789");

        $manager->persist($aircraft1);

        $aircraft2 = new Aircraft();
        $aircraft2->setModel($model)
            ->setRegistrationNumber("999498765");

        $manager->persist($aircraft2);


        // Airports
        $airport1 = new Airport();
        $airport1->setName("Paris-Charles-de-Gaulle")
            ->setIata("CDG")
            ->setCity("Roissy-en-France")
            ->setCountry("France");;

        $manager->persist($airport1);

        $airport2 = new Airport();
        $airport2->setName("Lyon-Saint-Exupéry")
            ->setIata("LYS")
            ->setCity("Colombier-Saugnieu")
            ->setCountry("France");;

        $manager->persist($airport2);


        // Pilots
        $pilot1 = new Pilot();
        $pilot1->setLicense("123445")
            ->setFlyingHours(150)
            ->setSalary(3500)
            ->setAddress("10bis boulevard des trois têtes")
            ->setSurname("Bertrand")
            ->setFirstname("Mendi")
            ->setNumSecu("32165468463854");

        $manager->persist($pilot1);

        $pilot2 = new Pilot();
        $pilot2->setLicense("213513")
            ->setFlyingHours(1000)
            ->setSalary(5300)
            ->setAddress("10 avenue Gambetta, 75005 Paris")
            ->setSurname("Dupont")
            ->setFirstname("Martin")
            ->setNumSecu("294037512000525");

        $manager->persist($pilot2);

        // Aircrew
        $crew1 = new AirCrew();
        $crew1->setSalary(4860)
            ->setAddress("18 rue sergent Michel Berthet, 69009 Lyon")
            ->setSurname("Lamartine")
            ->setFirstname("Christine")
            ->setNumSecu("234047512005756")
            ->setFlyingHours(500)
            ->setFunction("0");

        $manager->persist($crew1);

        $crew2 = new AirCrew();
        $crew2->setSalary(2560)
            ->setAddress("1 rue de l'oignon")
            ->setSurname("Kate")
            ->setFirstname("Isabella")
            ->setNumSecu("45533564351351")
            ->setFlyingHours(125)
            ->setFunction("2");

        $manager->persist($crew2);


        // Flights
        $flight1 = new Flight();
        $flight1->setAircraft($aircraft1)
            ->setDepartAirport($airport1)
            ->setArrivalAirport($airport2)
            ->setDepartDay("monday")
            ->setDuration("5");

        $manager->persist($flight1);

        $flight2 = new Flight();
        $flight2->setAircraft($aircraft2)
            ->setDepartAirport($airport2)
            ->setArrivalAirport($airport1)
            ->setDepartDay("friday")
            ->setDuration("5");

        $manager->persist($flight2);





        $manager->flush();
    }
}

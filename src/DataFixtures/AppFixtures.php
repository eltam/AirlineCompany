<?php

namespace App\DataFixtures;

use App\Entity\Aircraft;
use App\Entity\AircraftModel;
use App\Entity\AirCrew;
use App\Entity\Airport;
use App\Entity\Departure;
use App\Entity\Flight;
use App\Entity\GroundEmployee;
use App\Entity\Pilot;
use App\Entity\User;
use DateTime;
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
        $admin_user = new User();
        $admin_user->setSurname("Smith")
            ->setFirstname("Admin")
            ->setAddress("5 random road, random city, random Country")
            ->setEmail("admin@gmail.com")
            ->setRoles(['ROLE_ADMIN']);
            $admin_user->setPassword($this->passwordEncoder->encodePassword($admin_user, 'adminpassword'));

        $manager->persist($admin_user);

        $user1 = new User();
        $user1->setSurname("Johnson")
            ->setFirstname("User")
            ->setAddress("25 random road, random city, random Country")
            ->setEmail("user@gmail.com")
            ->setRoles(['ROLE_USER']);
        $user1->setPassword($this->passwordEncoder->encodePassword($user1, 'userpassword'));

        $manager->persist($user1);

        // Aircraft model
        $model = new AircraftModel();
        $model->setCapacity(180)
            ->setName("A320")
            ->setPiloting(2);

        $manager->persist($model);


        // Aircrafts
        $aircraft1 = new Aircraft();
        $aircraft1->setModel($model)
            ->setRegistrationNumber("1101119975");

        $manager->persist($aircraft1);

        $aircraft2 = new Aircraft();
        $aircraft2->setModel($model)
            ->setRegistrationNumber("2101119975");

        $manager->persist($aircraft2);

        $aircraft3 = new Aircraft();
        $aircraft3->setModel($model)
            ->setRegistrationNumber("3101119975");

        $manager->persist($aircraft3);

        $aircraft4 = new Aircraft();
        $aircraft4->setModel($model)
            ->setRegistrationNumber("4101119975");

        $manager->persist($aircraft4);

        $aircraft5 = new Aircraft();
        $aircraft5->setModel($model)
            ->setRegistrationNumber("5101119975");

        $manager->persist($aircraft5);


        // Airports
        $airport1 = new Airport();
        $airport1->setName("Paris-Charles-de-Gaulle")
            ->setIata("CDG")
            ->setDestination("Paris")
            ->setCity("Roissy-en-France")
            ->setCountry("France");

        $manager->persist($airport1);

        $airport2 = new Airport();
        $airport2->setName("Lyon-Saint-Exupéry")
            ->setIata("LYS")
            ->setDestination("Lyon")
            ->setCity("Colombier-Saugnieu")
            ->setCountry("France");;

        $manager->persist($airport2);

        $airport3 = new Airport();
        $airport3->setName("Nice Côte d'Azur")
            ->setIata("NCE")
            ->setDestination("Nice")
            ->setCity("Nice")
            ->setCountry("France");

        $manager->persist($airport3);

        $airport4 = new Airport();
        $airport4->setName("Toulouse-Blagnac")
            ->setIata("TLS")
            ->setDestination("Nice")
            ->setCity("Blagnac")
            ->setCountry("France");

        $manager->persist($airport4);

        $airport5 = new Airport();
        $airport5->setName("Léonard-de-Vinci de Rome Fiumicino")
            ->setIata("FCO")
            ->setDestination("Rome")
            ->setCity("Fiumicino")
            ->setCountry("Italie");

        $manager->persist($airport5);

        $airport6 = new Airport();
        $airport6->setName("Berlin-Schönefeld")
            ->setIata("SXF")
            ->setDestination("Berlin")
            ->setCity("Schönefeld")
            ->setCountry("Allemagne");

        $manager->persist($airport6);

        $airport7 = new Airport();
        $airport7->setName("Londres-Heathrow")
            ->setIata("LHR")
            ->setDestination("Londres")
            ->setCity("Londres")
            ->setCountry("Royaume-Uni");

        $manager->persist($airport7);

        $airport8 = new Airport();
        $airport8->setName("New York-John-F.-Kennedy")
            ->setIata("JFK")
            ->setDestination("New York")
            ->setCity("New York")
            ->setCountry("États-Unis");

        $manager->persist($airport8);

        // Pilots
        $pilot1 = new Pilot();
        $pilot1->setLicense("123445")
            ->setFlyingHours(15000)
            ->setSalary(3000)
            ->setStreet("10bis boulevard des trois têtes")
            ->setCity('Sceaux')
            ->setCountry('France')
            ->setSurname("Bertrand")
            ->setFirstname("Mendi")
            ->setNumSecu("123456789123456");

        $manager->persist($pilot1);

        $pilot2 = new Pilot();
        $pilot2->setLicense("213513")
            ->setFlyingHours(10000)
            ->setSalary(3000)
            ->setStreet("10 avenue Gambetta")
            ->setCity('Paris')
            ->setCountry('France')
            ->setSurname("Dupont")
            ->setFirstname("Martin")
            ->setNumSecu("223456789123456");

        $manager->persist($pilot2);

        $pilot3 = new Pilot();
        $pilot3->setLicense("313492")
            ->setFlyingHours(23000)
            ->setSalary(4500)
            ->setStreet("3 avenue des chevaux")
            ->setCity('Lyon')
            ->setCountry('France')
            ->setSurname("Roman")
            ->setFirstname("Alicia")
            ->setNumSecu("323456789123456");

        $manager->persist($pilot3);

        $pilot4 = new Pilot();
        $pilot4->setLicense("413492")
            ->setFlyingHours(30000)
            ->setSalary(6520)
            ->setStreet("15 avenue des Passereaux")
            ->setCity('Evry')
            ->setCountry('France')
            ->setSurname("Lilo")
            ->setFirstname("Patrick")
            ->setNumSecu("423456789123456");

        $manager->persist($pilot4);

        // Aircrew
        $crew1 = new AirCrew();
        $crew1->setSalary(4860)
            ->setStreet("18 avenue des zèbres")
            ->setCity('Montpellier')
            ->setCountry('France')
            ->setSurname("Lamartine")
            ->setFirstname("Christine")
            ->setNumSecu("134047512005756")
            ->setFlyingHours(26000)
            ->setFunction("0");

        $manager->persist($crew1);

        $crew2 = new AirCrew();
        $crew2->setSalary(2560)
            ->setStreet("1 rue de l'oignon")
            ->setCity('Ris-Orangis')
            ->setCountry('France')
            ->setSurname("Poussin")
            ->setFirstname("George")
            ->setNumSecu("255335643513512")
            ->setFlyingHours(31500)
            ->setFunction("1");

        $manager->persist($crew2);

        $crew3 = new AirCrew();
        $crew3->setSalary(2060)
            ->setStreet("5 rue des colombes")
            ->setCity('Alby-sur-Chéran')
            ->setCountry('France')
            ->setSurname("Kate")
            ->setFirstname("Isabella")
            ->setNumSecu("654789643513511")
            ->setFlyingHours(10500)
            ->setFunction("0");

        $manager->persist($crew3);

        $crew4 = new AirCrew();
        $crew4->setSalary(2060)
            ->setStreet("64 boulevard des pots")
            ->setCity('Paris')
            ->setCountry('France')
            ->setSurname("Montrouge")
            ->setFirstname("Léa")
            ->setNumSecu("987123643513512")
            ->setFlyingHours(10500)
            ->setFunction("2");

        $manager->persist($crew4);

        $ground_employee1 = new GroundEmployee();
        $ground_employee1->setSalary(1500)
            ->setStreet("35 rue des poissons")
            ->setCity('Nantes')
            ->setCountry('France')
            ->setSurname("Delavande")
            ->setFirstname("Louis")
            ->setNumSecu("357125543513551");

        $manager->persist($ground_employee1);

        $ground_employee2 = new GroundEmployee();
        $ground_employee2->setSalary(1500)
            ->setStreet("3 avenue des ruches")
            ->setCity('Brest')
            ->setCountry('France')
            ->setSurname("Rock")
            ->setFirstname("Yahn")
            ->setNumSecu("257135543514851");

        $manager->persist($ground_employee2);


        // Flights and departures

        $flight1 = new Flight();
        $flight1->setAircraft($aircraft1)
            ->setDepartAirport($airport1)
            ->setArrivalAirport($airport8)
            ->setDepartDay("monday")
            ->setDuration("13")
            ->setDepartTime(new \DateTime('05:00'));

        $manager->persist($flight1);

        $departure1_1 = new Departure();
        $departure1_1->setFlight($flight1);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight1->getDepartDay());
        $departure1_1->setDepartureDate($departure_date)
            ->setPassengers(180)
            ->setPilot($pilot1)
            ->setCopilot($pilot2)
            ->setPurser($crew1)
            ->setCrew($crew2)
            ->setPrice('450');

        $manager->persist($departure1_1);

        $departure1_2 = new Departure();
        $departure1_2->setFlight($flight1);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight1->getDepartDay());
        $departure_date->modify('+7 day');
        $departure1_2->setDepartureDate($departure_date)
            ->setPassengers(180)
            ->setPilot($pilot1)
            ->setCopilot($pilot2)
            ->setPurser($crew1)
            ->setCrew($crew2)
            ->setPrice('450');

        $manager->persist($departure1_2);

        $flight2 = new Flight();
        $flight2->setAircraft($aircraft1)
            ->setDepartAirport($airport8)
            ->setArrivalAirport($airport1)
            ->setDepartDay("tuesday")
            ->setDuration("13")
            ->setDepartTime(new \DateTime('07:00'));

        $manager->persist($flight2);

        $departure2_1 = new Departure();
        $departure2_1->setFlight($flight2);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight2->getDepartDay());
        $departure2_1->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot1)
            ->setCopilot($pilot2)
            ->setPurser($crew1)
            ->setCrew($crew2)
            ->setPrice('450');

        $manager->persist($departure2_1);

        $departure2_2 = new Departure();
        $departure2_2->setFlight($flight2);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight2->getDepartDay());
        $departure_date->modify('+7 day');
        $departure2_2->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot1)
            ->setCopilot($pilot2)
            ->setPurser($crew1)
            ->setCrew($crew2)
            ->setPrice('450');

        $manager->persist($departure2_2);

        $flight3 = new Flight();
        $flight3->setAircraft($aircraft2)
            ->setDepartAirport($airport1)
            ->setArrivalAirport($airport7)
            ->setDepartDay("monday")
            ->setDuration("2")
            ->setDepartTime(new \DateTime('08:00'));

        $manager->persist($flight3);

        $departure3_1 = new Departure();
        $departure3_1->setFlight($flight3);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight3->getDepartDay());
        $departure3_1->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot3)
            ->setCopilot($pilot4)
            ->setPurser($crew3)
            ->setCrew($crew4)
            ->setPrice('125');

        $manager->persist($departure3_1);

        $departure3_2 = new Departure();
        $departure3_2->setFlight($flight3);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight3->getDepartDay());
        $departure_date->modify('+7 day');
        $departure3_2->setDepartureDate($departure_date)
            ->setPassengers(180)
            ->setPilot($pilot3)
            ->setCopilot($pilot4)
            ->setPurser($crew3)
            ->setCrew($crew4)
            ->setPrice('125');

        $manager->persist($departure3_2);


        $flight4 = new Flight();
        $flight4->setAircraft($aircraft2)
            ->setDepartAirport($airport7)
            ->setArrivalAirport($airport1)
            ->setDepartDay("monday")
            ->setDuration("2")
            ->setDepartTime(new \DateTime('13:45'));

        $manager->persist($flight4);

        $departure4_1 = new Departure();
        $departure4_1->setFlight($flight4);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight4->getDepartDay());
        $departure4_1->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot3)
            ->setCopilot($pilot4)
            ->setPurser($crew3)
            ->setCrew($crew4)
            ->setPrice('125');

        $manager->persist($departure4_1);

        $departure4_2 = new Departure();
        $departure4_2->setFlight($flight4);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight4->getDepartDay());
        $departure_date->modify('+7 day');
        $departure4_2->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot3)
            ->setCopilot($pilot4)
            ->setPurser($crew3)
            ->setCrew($crew4)
            ->setPrice('125');

        $manager->persist($departure4_2);

        $flight5 = new Flight();
        $flight5->setAircraft($aircraft2)
            ->setDepartAirport($airport1)
            ->setArrivalAirport($airport2)
            ->setDepartDay("tuesday")
            ->setDuration("1")
            ->setDepartTime(new \DateTime('06:30'));

        $manager->persist($flight5);

        $departure5_1 = new Departure();
        $departure5_1->setFlight($flight5);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight5->getDepartDay());
        $departure5_1->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot3)
            ->setCopilot($pilot4)
            ->setPurser($crew3)
            ->setCrew($crew4)
            ->setPrice('70');

        $manager->persist($departure5_1);

        $departure5_2 = new Departure();
        $departure5_2->setFlight($flight5);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight5->getDepartDay());
        $departure_date->modify('+7 day');
        $departure5_2->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot3)
            ->setCopilot($pilot4)
            ->setPurser($crew3)
            ->setCrew($crew4)
            ->setPrice('70');

        $manager->persist($departure5_2);

        $flight6 = new Flight();
        $flight6->setAircraft($aircraft2)
            ->setDepartAirport($airport2)
            ->setArrivalAirport($airport1)
            ->setDepartDay("tuesday")
            ->setDuration("1")
            ->setDepartTime(new \DateTime('12:25'));

        $manager->persist($flight6);

        $departure6_1 = new Departure();
        $departure6_1->setFlight($flight6);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight6->getDepartDay());
        $departure6_1->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot3)
            ->setCopilot($pilot4)
            ->setPurser($crew3)
            ->setCrew($crew4)
            ->setPrice('70');

        $manager->persist($departure6_1);

        $departure6_2 = new Departure();
        $departure6_2->setFlight($flight6);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight6->getDepartDay());
        $departure_date->modify('+7 day');
        $departure6_2->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot3)
            ->setCopilot($pilot4)
            ->setPurser($crew3)
            ->setCrew($crew4)
            ->setPrice('70');

        $manager->persist($departure6_2);

        $flight7 = new Flight();
        $flight7->setAircraft($aircraft1)
            ->setDepartAirport($airport1)
            ->setArrivalAirport($airport3)
            ->setDepartDay("wednesday")
            ->setDuration("1")
            ->setDepartTime(new \DateTime('10:40'));

        $manager->persist($flight7);

        $departure7_1 = new Departure();
        $departure7_1->setFlight($flight7);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight7->getDepartDay());
        $departure7_1->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot1)
            ->setCopilot($pilot2)
            ->setPurser($crew1)
            ->setCrew($crew2)
            ->setPrice('95');

        $manager->persist($departure7_1);

        $departure7_2 = new Departure();
        $departure7_2->setFlight($flight7);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight7->getDepartDay());
        $departure_date->modify('+7 day');
        $departure7_2->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot1)
            ->setCopilot($pilot2)
            ->setPurser($crew1)
            ->setCrew($crew2)
            ->setPrice('95');

        $manager->persist($departure7_2);


        $flight8 = new Flight();
        $flight8->setAircraft($aircraft1)
            ->setDepartAirport($airport3)
            ->setArrivalAirport($airport1)
            ->setDepartDay("wednesday")
            ->setDuration("1")
            ->setDepartTime(new \DateTime('20:55'));

        $manager->persist($flight8);

        $departure8_1 = new Departure();
        $departure8_1->setFlight($flight8);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight8->getDepartDay());
        $departure8_1->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot1)
            ->setCopilot($pilot2)
            ->setPurser($crew1)
            ->setCrew($crew2)
            ->setPrice('95');

        $manager->persist($departure8_1);

        $departure8_2 = new Departure();
        $departure8_2->setFlight($flight8);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight8->getDepartDay());
        $departure_date->modify('+7 day');
        $departure8_2->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot1)
            ->setCopilot($pilot2)
            ->setPurser($crew1)
            ->setCrew($crew2)
            ->setPrice('95');

        $manager->persist($departure8_2);

        $flight9 = new Flight();
        $flight9->setAircraft($aircraft2)
            ->setDepartAirport($airport3)
            ->setArrivalAirport($airport2)
            ->setDepartDay("wednesday")
            ->setDuration("1")
            ->setDepartTime(new \DateTime('11:15'));

        $manager->persist($flight9);

        $departure9_1 = new Departure();
        $departure9_1->setFlight($flight9);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight9->getDepartDay());
        $departure9_1->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot3)
            ->setCopilot($pilot4)
            ->setPurser($crew3)
            ->setCrew($crew4)
            ->setPrice('65');

        $manager->persist($departure9_1);

        $departure9_2 = new Departure();
        $departure9_2->setFlight($flight9);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight9->getDepartDay());
        $departure_date->modify('+7 day');
        $departure9_2->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot3)
            ->setCopilot($pilot4)
            ->setPurser($crew3)
            ->setCrew($crew4)
            ->setPrice('65');

        $manager->persist($departure9_2);

        $flight10 = new Flight();
        $flight10->setAircraft($aircraft2)
            ->setDepartAirport($airport2)
            ->setArrivalAirport($airport3)
            ->setDepartDay("wednesday")
            ->setDuration("1")
            ->setDepartTime(new \DateTime('18:32'));

        $manager->persist($flight10);

        $departure10_1 = new Departure();
        $departure10_1->setFlight($flight10);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight10->getDepartDay());
        $departure10_1->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot3)
            ->setCopilot($pilot4)
            ->setPurser($crew3)
            ->setCrew($crew4)
            ->setPrice('65');

        $manager->persist($departure10_1);

        $departure10_2 = new Departure();
        $departure10_2->setFlight($flight10);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight10->getDepartDay());
        $departure_date->modify('+7 day');
        $departure10_2->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot3)
            ->setCopilot($pilot4)
            ->setPurser($crew3)
            ->setCrew($crew4)
            ->setPrice('65');

        $manager->persist($departure10_2);

        $flight11 = new Flight();
        $flight11->setAircraft($aircraft1)
            ->setDepartAirport($airport1)
            ->setArrivalAirport($airport5)
            ->setDepartDay("thursday")
            ->setDuration("3")
            ->setDepartTime(new \DateTime('09:20'));

        $manager->persist($flight11);

        $departure11_1 = new Departure();
        $departure11_1->setFlight($flight11);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight11->getDepartDay());
        $departure11_1->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot1)
            ->setCopilot($pilot2)
            ->setPurser($crew1)
            ->setCrew($crew2)
            ->setPrice('230');

        $manager->persist($departure11_1);

        $departure11_2 = new Departure();
        $departure11_2->setFlight($flight11);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight11->getDepartDay());
        $departure_date->modify('+7 day');
        $departure11_2->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot1)
            ->setCopilot($pilot2)
            ->setPurser($crew1)
            ->setCrew($crew2)
            ->setPrice('230');

        $manager->persist($departure11_2);

        $flight12 = new Flight();
        $flight12->setAircraft($aircraft1)
            ->setDepartAirport($airport5)
            ->setArrivalAirport($airport1)
            ->setDepartDay("thursday")
            ->setDuration("3")
            ->setDepartTime(new \DateTime('17:00'));

        $manager->persist($flight12);

        $departure12_1 = new Departure();
        $departure12_1->setFlight($flight12);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight12->getDepartDay());
        $departure12_1->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot1)
            ->setCopilot($pilot2)
            ->setPurser($crew1)
            ->setCrew($crew2)
            ->setPrice('230');

        $manager->persist($departure12_1);

        $departure12_2 = new Departure();
        $departure12_2->setFlight($flight12);

        $departure_date = new DateTime();
        $departure_date->modify('next '.$flight12->getDepartDay());
        $departure_date->modify('+7 day');
        $departure12_2->setDepartureDate($departure_date)
            ->setPassengers(0)
            ->setPilot($pilot1)
            ->setCopilot($pilot2)
            ->setPurser($crew1)
            ->setCrew($crew2)
            ->setPrice('230');

        $manager->persist($departure12_2);

        $manager->flush();
    }
}

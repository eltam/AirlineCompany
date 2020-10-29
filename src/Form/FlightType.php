<?php

namespace App\Form;

use App\Entity\Flight;
use App\Repository\AircraftRepository;
use App\Repository\AirportRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlightType extends AbstractType
{
    /**
     * @var AirportRepository
     */
    private $airport_repository;

    /**
     * @var AircraftRepository
     */
    private $aircraft_repository;

    /**
     * AircraftType constructor.
     * @param AirportRepository $airport_repository
     * @param AircraftRepository $aircraft_repository
     */
    public function __construct(AirportRepository $airport_repository, AircraftRepository $aircraft_repository) {
        $this->airport_repository = $airport_repository;
        $this->aircraft_repository = $aircraft_repository;

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('depart_day', ChoiceType::class, [
                'choices' => $this->getWeekDayChoices()
            ])
            ->add('duration')
            ->add('depart_airport', ChoiceType::class, [
                'choices' => $this->getAirportChoices()
            ])
            ->add('arrival_airport', ChoiceType::class, [
                'choices' => $this->getAirportChoices()
            ])
            ->add('aircraft', ChoiceType::class, [
                'choices' => $this->getAircraftChoices()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Flight::class,
            'translation_domain' => 'forms'
        ]);
    }

    public function getAirportChoices() {
        $choices = [];
        $airports = $this->airport_repository->findAll();
        foreach ($airports as $airport) {
            $choices[$airport->getIata()] = $airport;
        }
        return $choices;
    }

    public function getAircraftChoices() {
        $choices = [];
        $aircrafts = $this->aircraft_repository->findAll();
        foreach ($aircrafts as $aircraft) {
            $choices[$aircraft->getRegistrationNumber()] = $aircraft;
        }
        return $choices;
    }

    public function getWeekDayChoices() {
        $choices = [];
        $choices["Lundi"] = "monday";
        $choices["Mardi"] = "tuesday";
        $choices["Mercredi"] = "wednesday";
        $choices["Jeudi"] = "thurday";
        $choices["Vendredi"] = "friday";
        $choices["Samedi"] = "saturday";
        $choices["Dimanche"] = "sunday";
        return $choices;
    }

}

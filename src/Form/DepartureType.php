<?php

namespace App\Form;

use App\Entity\Departure;
use App\Repository\AirCrewRepository;
use App\Repository\FlightRepository;
use App\Repository\PilotRepository;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepartureType extends AbstractType
{

    /**
     * @var PilotRepository
     */
    private $pilot_repository;

    /**
     * @var AirCrewRepository
     */
    private $aircrew_repository;

    /**
     * @var FlightRepository
     */
    private $flight_repository;


    public function __construct(PilotRepository $pilot_repository, FlightRepository $flight_repository, AirCrewRepository $aircrew_repository) {
        $this->pilot_repository = $pilot_repository;
        $this->flight_repository = $flight_repository;
        $this->aircrew_repository = $aircrew_repository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pilot', ChoiceType::class, [
                'choices' => $this->getPilotChoices()
            ])
            ->add('copilot', ChoiceType::class, [
                'choices' => $this->getPilotChoices()
            ])
            ->add('purser', ChoiceType::class, [
                'multiple' =>false,
                'choices' => $this->getAircrewChoices()
            ])
            ->add('crew', ChoiceType::class, [
                'multiple' =>false,
                'choices' => $this->getAircrewChoices()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Departure::class,
            'translation_domain' => 'forms'
        ]);
    }

    public function getPilotChoices() {
        $choices = [];
        $pilots = $this->pilot_repository->findAll();
        foreach ($pilots as $pilot) {
            $choices[$pilot->getFullname()] = $pilot;
        }
        return $choices;
    }

    public function getAircrewChoices() {
        $choices = [];
        $aircrew = $this->aircrew_repository->findAll();
        foreach ($aircrew as $member) {
            $choices[$member->getFullname()] = $member;
        }
        return $choices;
    }

}

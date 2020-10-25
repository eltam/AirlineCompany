<?php

namespace App\Form;

use App\Entity\Aircraft;
use App\Repository\AircraftModelRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AircraftType extends AbstractType
{
    /**
     * @var AircraftModelRepository
     */
    private $aircraft_model_repository;

    /**
     * AircraftType constructor.
     * @param AircraftModelRepository $aircraft_model_repository
     */
    public function __construct(AircraftModelRepository $aircraft_model_repository) {
        $this->aircraft_model_repository = $aircraft_model_repository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('registration_number')
            ->add('model', ChoiceType::class, [
                'choices' => $this->getChoices()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Aircraft::class,
            'translation_domain' => 'forms',
        ]);
    }

    public function getChoices() {
        $choices = [];
        $aircraft_models = $this->aircraft_model_repository->findAll();
        foreach ($aircraft_models as $aircraft_model) {
            $choices[$aircraft_model->getName()] = $aircraft_model;
        }
        return $choices;
    }
}

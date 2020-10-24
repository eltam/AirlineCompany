<?php

namespace App\Form;

use App\Entity\AirCrew;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AircrewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('num_secu')
            ->add('surname')
            ->add('firstname')
            ->add('address')
            ->add('salary')
            ->add('flying_hours')
            ->add('function')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AirCrew::class,
            'translation_domain' => 'forms'
        ]);
    }
}

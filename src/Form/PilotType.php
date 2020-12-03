<?php

namespace App\Form;

use App\Entity\Pilot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PilotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('num_secu')
            ->add('surname')
            ->add('firstname')
            ->add('street')
            ->add('city')
            ->add('country')
            ->add('salary')
            ->add('flying_hours')
            ->add('license')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pilot::class,
            'translation_domain' => 'forms'
        ]);
    }
}

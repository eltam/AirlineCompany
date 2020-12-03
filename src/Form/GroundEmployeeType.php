<?php

namespace App\Form;

use App\Entity\GroundEmployee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroundEmployeeType extends AbstractType
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GroundEmployee::class,
            'translation_domain' => 'forms'
        ]);
    }
}

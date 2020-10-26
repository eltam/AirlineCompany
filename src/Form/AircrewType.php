<?php

namespace App\Form;

use App\Entity\AirCrew;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('function', ChoiceType::class, [
                'choices' => $this->getFunctionChoices()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AirCrew::class,
            'translation_domain' => 'forms'
        ]);
    }

    public function getFunctionChoices()
    {
        $choices = AirCrew::FUNCTION;
        $output = [];
        foreach ($choices as $k => $value) {
            $output[$value] = $k;
        }
        return $output;
    }
}

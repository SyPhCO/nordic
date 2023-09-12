<?php

namespace App\Form;

use App\Entity\Horde;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HordeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('breed')
            ->add('gender')
            ->add('birth')
            ->add('description')
            ->add('slug')
            ->add('illustration')
            ->add('wonderland')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Horde::class,
        ]);
    }
}

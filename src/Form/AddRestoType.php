<?php

namespace App\Form;

use App\Entity\Resto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddRestoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'attr' => [
                'placeholder' => 'Le nom de la Resto',
                'class' => 'col-sm-10'
            ]
        ])
        ->add('adresse', TextType::class, [
            'attr' => [
                'placeholder' => 'Le adresse de la Resto',
                'class' => 'col-sm-10'
            ]
        ])
        ->add('ville', TextType::class, [
            'attr' => [
                'placeholder' => 'ville de la Resto',
                'class' => 'col-sm-10'
            ]
        ])
        ->add('tel', TextType::class, [
            'attr' => [
                'placeholder' => 'tel de la Resto',
                'class' => 'col-sm-10'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'data_class'=> Resto::class,
        ]);
    }
}

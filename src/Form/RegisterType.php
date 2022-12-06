<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'attr' => [
                'placeholder' => 'Le nom de la Resto',
                'class' => 'form-control'
            ]
        ])
        ->add('prenom', TextType::class, [
            'attr' => [
                'placeholder' => 'Le nom de la Resto',
                'class' => 'form-control'
            ]
        ])
        ->add('email', TextType::class, [
            'attr' => [
                'placeholder' => 'Le nom de la Resto',
                'class' => 'form-control'
            ]
        ])
        ->add('password', TextType::class, [
            'attr' => [
                'placeholder' => 'Le nom de la Resto',
                'class' => 'form-control'
            ]
        ])
        ->add('tel', TextType::class, [
            'attr' => [
                'placeholder' => 'Le nom de la Resto',
                'class' => 'form-control'
            ]
        ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}

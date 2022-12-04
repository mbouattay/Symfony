<?php

namespace App\Form;

use App\Entity\Menu;
use App\Entity\Resto;
use App\Repository\RestoRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddmenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'attr' => [
                'placeholder' => 'Le nom de menu',
                'class' => 'col-sm-10'
            ]
        ])
        ->add('prix', TextType::class, [
            'attr' => [
                'placeholder' => 'Le prix de la menu',
                'class' => 'col-sm-10'
            ]
        ])
        ->add('resto', EntityType::class, [
            'class' => Resto::class,
            'choice_label' => 'nom',
            'placeholder' => 'Choose a country',
          
        ]);
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}

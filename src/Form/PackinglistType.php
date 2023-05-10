<?php

namespace App\Form;

use App\Entity\Packinglist;
use App\Entity\Preferences;
use App\Entity\Season;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PackinglistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ["class" => "form-control rounded-0 w-100"]
            ])
            ->add('icon', TextType::class, [
                'attr' => ["class" => "form-control rounded-0 w-100"]
            ])
            ->add('fk_type', EntityType::class, [
                'attr' => ["class" => "form-select rounded-0 w-100"],
                'class' => Type::class,
                'choice_label' => 'name',
                'label' => 'Type',
            ])
            ->add('fk_preferences', EntityType::class, [
                'attr' => ["class" => "form-select rounded-0 w-100"],
                'class' => Preferences::class,
                'choice_label' => 'name',
                'label' => 'Preferences',
            ])
            ->add('fk_season', EntityType::class, [
                'attr' => ["class" => "form-select rounded-0 w-100"],
                'class' => Season::class,
                'choice_label' => 'name',
                'label' => 'Season',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Packinglist::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Journal;
use App\Entity\User;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class JournalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'attr' => ["class" => "form-control rounded-0 w-100"]
        ])
            ->add('picture', FileType::class, [
                'attr' => ["class" => "form-control rounded-0 w-100"],
                'label' => 'Upload Picture',
//unmapped means that is not associated to any entity property
                'mapped' => false,
//not mandatory to have a file
                'required' => false,

//in the associated entity, so you can use the PHP constraint classes as validators
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file',
                    ])
                ],
            ])
            ->add('description', TextType::class, [
                'attr' => ["class" => "form-control rounded-0 w-100"]
            ])
            ->add('website', TextType::class, [
                'attr' => ["class" => "form-control rounded-0 w-100"]
            ])
            ->add('fk_user', EntityType::class, [
                'attr' => ['class' => 'form-select rounded-0 w-100', 'style' => 'margin-bottom:1rem'],
                'class' => User::class,
                'choice_label' => 'first_name',
                'label' => 'User',
            ])   
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Journal::class,
        ]);
    }
}

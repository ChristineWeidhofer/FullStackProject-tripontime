<?php

namespace App\Form;

use App\Entity\Activity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, array("attr"=>array("class"=>"form-control")))
            ->add('image', null, array("attr"=>array("class"=>"form-control")))
            ->add('description', null, array("attr"=>array("class"=>"form-control")))
            ->add('website', null, array("attr"=>array("class"=>"form-control")))
            ->add('capacity', null, array("attr"=>array("class"=>"form-control")))
            ->add('review', null, array("attr"=>array("class"=>"form-control")));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }
}

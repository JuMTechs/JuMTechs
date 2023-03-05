<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class HostType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Name')
        ->add('Age')
        ->add('Job')
        ->add('file',FileType::class,[
            'label' => 'Image',
            'required' => false,
            'mapped' =>false
            ])
        ->add('Image',HiddenType::class,[
            'required' =>false
            ])
        ->add('save',SubmitType::class,[
            'label' => "Confirm"
            ])
        ;
    }
}
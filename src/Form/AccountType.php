<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class AccountType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('eventName')
        ->add('eventImage',HiddenType::class,[
            'required' =>false
            ])
        ->add('eventStartDay')
        ->add('eventEndDay')
        ->add('eventDetail')
        ->add('save',SubmitType::class,[
            'label' => "Confirm"
            ]);
    }
}
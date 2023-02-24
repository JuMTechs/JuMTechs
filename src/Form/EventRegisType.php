<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class EventRegisType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        // ->add('eventId')
        // ->add('UserID')
        ->add('phonenumber')
        ->add('comment')
        ->add('save',SubmitType::class,[
            'label' => "Confirm"
        ]);
    }
}
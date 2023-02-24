<?php

namespace App\Form;

use Doctrine\ORM\Query\AST\Functions\AbsFunction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class EventType extends AbstractType{
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
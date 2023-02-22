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
        ->add('eve_name')
        ->add('created',DateType::class,[
            'widget' => 'single_text','required' =>false
        ])
        ->add('file',FileType::class,[
            'label' => 'Event Image',
            'required' => false,
            'mapped' =>false
        ])
        ->add('eve_img',HiddenType::class,[
            'required' =>false
        ])

        ->add('eve_start_day')
        ->add('eve_end_day')
        ->add('eve_detail')

        ->add('save',SubmitType::class,[
            'label' => "Confirm"
        ]);
    }
}
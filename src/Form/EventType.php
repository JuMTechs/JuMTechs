<?php

namespace App\Form;

use App\Entity\Event;
use Doctrine\ORM\Query\AST\Functions\AbsFunction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('eventName')
        ->add('file',FileType::class,[
            'label' => 'Event Image',
            'required' => false,
            'mapped' =>false
        ])
        ->add('eventImage',HiddenType::class,[
            'required' =>false
        ])
        ->add('eventStartDay')
        ->add('eventEndDay')
        ->add('eventDetail')
        
        ->add('created',DateType::class,['data'=>new \DateTime(),'disabled'=>true])

        ->add('save',SubmitType::class,[
            'label' => "Confirm"
        ]);
    }

    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefaults([
    //         'data_class'=>Event::class
    //     ]);
    // }
}
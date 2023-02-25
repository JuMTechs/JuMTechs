<?php

namespace App\Form;

use App\Entity\EventHostInfo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
        ->add('file',FileType::class,[
            'label' => 'eventImage',
            'required' => false,
            'mapped' =>false
        ])
        ->add('eventImage',HiddenType::class,[
            'required' =>false
        ])
        ->add('eventStartDay')
        ->add('eventEndDay')
        ->add('eventDetail')
            
        // cach chua loi convert to string
        // cach lay du lieu bang EventHostInfo -- choice_label -> host_id

        ->add('host', EntityType::class, ['class'=>EventHostInfo::class, 'choice_label'=>'id'])

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
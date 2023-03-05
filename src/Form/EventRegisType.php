<?php

namespace App\Form;

use Doctrine\Common\Collections\Expr\Value;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class EventRegisType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('phonenumber')
        ->add('comment')
        ->add('event', HiddenType::class, ['data'=>null])
        ->add('user',HiddenType::class, ['data'=>null])
        ->add('save',SubmitType::class,[
            'label' => "Confirm"
            ]);
    }
}
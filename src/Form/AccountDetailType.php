<?php

namespace App\Form;

use App\Entity\AccountDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountDetailType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('user',HiddenType::class, ['data'=>null])
        ->add('status')
        ->add('file',FileType::class,[
            'label' => 'Image',
            'required' => false,
            'mapped' =>false
            ])
        ->add('image',HiddenType::class,[
            'required' =>false
            ])
        ->add('birthday')
        ->add('save',SubmitType::class,[
            'label' => "Confirm"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>AccountDetail::class
        ]);
    }
}
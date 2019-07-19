<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('isSubscribe', CheckboxType::class, [
                'attr' => [
                    'class' => 'checkbox'
                ],
                'required' => false
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

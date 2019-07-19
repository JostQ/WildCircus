<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'textarea'
                ]
            ])
            ->add('price', TextType::class, [
                'attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('date', DateType::class)
            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('postal', TextType::class, [
                'attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}

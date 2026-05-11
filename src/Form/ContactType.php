<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           ->add('name', TextType::class, [
               'label' => 'Nom',
               'attr' => [
                   'placeholder' => 'Ton nom',
               ],
               'constraints' => [
                   new Assert\NotBlank(),
                   new Assert\Length(min: 2, max: 50),
                   new Assert\Regex(pattern: '/^[a-zA-ZÀ-ÿ\s\-]+$/'),
               ],
           ])

->add('email', EmailType::class, [
    'label' => 'Email',
    'attr' => [
        'placeholder' => 'Ton email',
    ],
    'constraints' => [
        new Assert\NotBlank(),
        new Assert\Email(),
    ],
])

->add('subject', TextType::class, [
    'label' => 'Sujet',
    'attr' => [
        'placeholder' => 'Sujet du message',
    ],
    'constraints' => [
        new Assert\NotBlank(),
        new Assert\Length(min: 2, max: 100),
    ],
])

->add('message', TextareaType::class, [
    'label' => 'Message',
    'attr' => [
        'placeholder' => 'Ton message',
    ],
    'constraints' => [
        new Assert\NotBlank(),
        new Assert\Length(min: 5, max: 1000),
    ],

])
->add('website', HiddenType::class, [
    'mapped' => false,
    'required' => false,
]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}

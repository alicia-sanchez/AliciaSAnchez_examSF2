<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Twig\Node\Expression\Binary\SubBinary;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, 
            [
                'label' => 'Email',
              'required' => true,
            ])
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'admin' => 'ROLE_ADMIN',
                    'user' => 'ROLE_USER'
                ]])

            ->add('password', PasswordType::class, 
            [
                'attr' => ['autocomplete' => 'new-password'],
                'required' => true,
            ])

            ->add('firstname', TextType::class, 
            [
                'required' => true,
            ])
            ->add('lastname', TextType::class, 
            [
                'required' => true,
            ])
            ->add('ReleaseDate', DateType::class, 
            [
                'format' => 'dd/MM/yyyy',
            ])
            ->add('image', TextType::class, [
                'label' => 'Image',
                'required' => false, 
            ])
            ->add('job', ChoiceType::class, [
                'choices' => [
                    'RH' => 'RH',
                    'Informatique' => 'Informatique',
                    'Comptabilité' => 'Comptabilité',
                    'Direction' => 'Direction',
                ],
                'placeholder' => 'Choose a job',
            ])
            ->add('contract', ChoiceType::class, [
                'choices' => [
                    'CDI' => 'CDI',
                    'CDD' => 'CDD',
                    'Interim' => 'Interim',
                ],
                'placeholder' => 'Choose a contract', 
            ])
            ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

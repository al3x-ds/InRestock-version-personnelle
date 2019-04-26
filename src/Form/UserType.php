<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{

    

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse mail'
                ])
            ->add('username', TextType::class, [
                'label' => 'Nom d\'utilisateur'
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom',  
                ])
            ->add('password', RepeatedType::class, [
                    'constraints' => [
                        new NotBlank()
                    ],
                    'empty_data' => ' ',
                    'required' => false,
                    'type' => PasswordType::class,
                    'invalid_message' => 'Les deux mots de passes doivent êtres identiques !',
                    'options' => [
                        'attr' => [
                            'class' => 'password-field'
                        ]
                    ],
    
                    'first_options'  => [
                        'label' => 'Mot de passe',
                    ],
                    'second_options' => [
                        'label' => 'Verification du mot de passe'
                    ],
            ])
            ->add('role')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

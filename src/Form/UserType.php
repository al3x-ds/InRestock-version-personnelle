<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
        $listener = function (FormEvent $event) {
            $user = $event->getData();
            $form = $event->getForm();
        
            if(is_null($user->getId())){
                $form->add('password', RepeatedType::class, [
                    'constraints' => [
                        new NotBlank()
                    ],
                    'empty_data' => '',
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
                ]);
            } else {
                $form->add('password', RepeatedType::class, [
                    'empty_data' => '',
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
                        'attr' => [
                            'placeholder' => 'Laissez vide si inchangé'
                        ]
                    ],
                    'second_options' => [
                        'label' => 'Verification du mot de passe'
                    ],
                ]);
            }
        };

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
            ->addEventListener(FormEvents::PRE_SET_DATA, $listener)  
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

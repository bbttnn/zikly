<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'user email',
                'required' => true,
               
                'constraints' => [
                    new NotBlank([
                        'message' => "this field must be completed",
                    ]),
                    new Email([
                        'message' => "email address must be valid",
                    ]),
                ],

            ])
            
            ->add('plainPassword', PasswordType::class, [
                'label'=>'Mot de passe',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],

            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "This field must be completed",
                    ]),
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'required' => true,                
                'constraints' => [
                    new NotBlank([
                        'message' => "This field must be completed",
                    ]),
                ],
            ])
            ->add('image', FileType::class, [
                'mapped' => false,
                'required' => false,
                'multiple' =>false,
                'label' => 'Téléchargez une image',
                'attr' => [
                    'placeholder' => 'upload an image from your computer',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => "2048k",
                        'mimeTypes' => [
                            "image/png",
                            "image/jpg",
                            "image/jpeg",
                            "image/gif",
                        ]
                        
                    ])

                ],

            ])
            
            
            
            ->add('role',TextType::class,[
            'label'=>'Rôle',
            'required' => false,  

            ] )

            ->add('location', TextType::class, [
                'label' => "Ville",
                'required' => false,               
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

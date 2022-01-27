<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'label' => 'Your email address',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "This field must be completed",
                    ]),
                    new Email([
                        'message'=> "email address must be valid",
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
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
                'label' => 'firstname',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "This field must be completed",
                    ]),                
                ]
            ])   
            ->add('lastname', TextType::class, [
                'label' => 'lastname',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "This field must be completed",
                    ]),                
                ]
            ])           
            ->add('role', TextType::class, [
                'label' => 'role',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "This field must be completed",
                    ]),
                    
                ]
            ])
            ->add('location', TextType::class, [
                'label' => 'location',
                'required' => true,
                'attr' => [
                    'placeholder' => '',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "This field must be completed",
                    ]),
                    
                ]
            ])

            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

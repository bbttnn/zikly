<?php

namespace App\Form;

use App\Form\Builder\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Email;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Votre adresse e-mail',
                'required' => true,
                'attr' => [
                    'placeholder' => '',

                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'This field should be completed ',
                    ]),
                    new Email([
                      'message' => 'Valid email address required' 
                    ])
                ],
            ])
            ->add('subject', TextType::class, [
                'label' => 'Objet',
                'required' => true,
                'attr' => [
                    'placeholder' => '',

                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'This field should be completed ',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'The subject should be at least {{ limit }} characters',
                        'max' => 100,
                        'maxMessage' => 'The subject should not exceed {{ limit }} characters',
                    ]),
                ],
            ])

            ->add('message', TextareaType::class, [
                'label' => "Votre message",
                'required' => true,
                'attr' => [
                    'placeholder' => "",
                    'rows' => 4,
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'This field should be completed ',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Your message should be at least {{ limit }} characters',
                        'max' => 1000,
                        'maxMessage' => 'Your message should not exceed {{ limit }} characters',

                    ]),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}

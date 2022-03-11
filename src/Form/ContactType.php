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
           ->add('firstname', TextType::class, [
            'label' => 'Prénom',
            'required' => true,
            'attr' => [
                'placeholder' => '',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => "Ce champ doit être renseigné",
                ]),
            ],
        ])
        ->add('lastname', TextType::class, [
            'label' => 'Nom',
            'required' => true,                
            'constraints' => [
                new NotBlank([
                    'message' => "Ce champ doit être renseigné",
                ]),
            ],
        ])
        ->add('email', EmailType::class, [
                'label' => ' E-mail',
                'required' => true,
                'attr' => [
                    'placeholder' => '',

                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ doit être renseigné ',
                    ]),
                    new Email([
                      'message' => 'Entrez un e-mail valide' 
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
                        'message' => 'Ce champ doit être renseigné ',
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
                        'message' => 'Ce champ doit être renseigné ',
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

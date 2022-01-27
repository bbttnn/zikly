<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom de la categorie",
                'required' => true,
                'attr' => [
                    'placeholder' => "",
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "this field must be completed",
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => "category name must contain {{ limit }} chars min",
                        'max' => 100,
                        'maxMessage' => "category name must contain {{ limit }} chars max",  //protege des injections sql

                    ])

                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Your firstname',
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
                'label' => 'Your name',
                'required' => true,                
                'constraints' => [
                    new NotBlank([
                        'message' => "This field must be completed",
                    ]),
                ],
            ])
            ->add('title',TextType::class,[
                'label'=> 'title',
                'required'=> true,
                'attr' => [
                    'placeholder' => 'enter  title',
    
                   ],
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}

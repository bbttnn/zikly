<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class, [
            'label' => 'Titre',
            'required' => true,
            'attr' => [
                'placeholder' => '',

            ],
        ])
        ->add('content', TextareaType::class, [
            'label' => "Contenu",
            'required' => false,
            'attr' => [
                'placeholder' => "",
                'rows' => 6,

            ],
        ])        
        ->add('author',TextType::class,[
            'label'=>'Auteur',
            'required' => true,
        ]) 
        ->add('image', FileType::class, [
            'mapped' => false,
            'required' => true,
            'multiple' => false,
            'label' => 'Image',
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
                    ],
                ])

            ],

        ])  
            
            
            
            ->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}

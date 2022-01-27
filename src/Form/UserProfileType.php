<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\UserProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
       
            ->add('Biography',TextareaType::class,[
               'label' => 'userProfile biography',
               'required'=>true,
               'attr' => [
                'placeholder' => 'enter  biography',
                'rows'=> 4,

               ],
            
               ])
            ->add('title',TextType::class,[
                'label'=> 'userProfile title',
                'required'=> true,
                'attr' => [
                    'placeholder' => 'enter  title',
    
                   ],
            ])
            ->add('image', FileType::class, [
                'mapped' => false,
                'required' => false,
                'multiple' => true,
              
                'attr' => [
                    'placeholder' => 'upload an image from your computer',
                ],
                'constraints' => [
                    new All([
                       'constraints' =>[
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
                
         ],
         
      ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserProfile::class,
        ]);
    }
}

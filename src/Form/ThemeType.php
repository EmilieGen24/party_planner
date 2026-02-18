<?php

namespace App\Form;

use App\Entity\Color;
use App\Entity\Theme;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\File;

class ThemeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class,[
                'label'=> 'Le nom de ton titre : ',
                'constraints'=>[
                    new Assert\NotBlank([
                        'message'=>'Le champ titre ne peux pas être vide',]),
                    ],
                'attr' => [
                    'class' => 'add-theme'
                ]
            ])
             ->add('description', TextareaType::class,[
                'label' => 'Description : ',
                'attr' => [
                    'class' => 'add-theme-area'
                ]
            ])
            ->add('colors', EntityType::class, [
                'class' => Color::class,
                'label' => 'Couleur : ',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,

            ])
             ->add('imageFile', FileType::class, [
                'required' => false,
                'label' => ' ',
                'mapped' => true,
                'attr' => [
                    'class' => 'add-img'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader une image valide (JPEG, PNG, GIF).',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Theme::class,
        ]);
    }
}

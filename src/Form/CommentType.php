<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('comment_text', TextareaType::class, [
                'label' => 'Votre commentaire : ',
                'attr' => [
                    'rows' => 6,
                    'placeholder' => 'Écrivez votre commentaire ici...',
                    'class'=> 'commentaire-area'
                ]
            ])
            // ->add('theme', EntityType::class, [
            //     'class' => Theme::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}

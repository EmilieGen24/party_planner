<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('username')
            // ->add('roles')
            // ->add('password')
             ->add('name', TextType::class,[
                'label' => 'Nom : ',
                'attr' => [
                    'class' => 'contact-label'
                ]
            ])
            ->add('email', EmailType::class,[
                'label' => 'Email : ',
                'attr' => [
                    'class' => 'contact-label'
                ]
            ])
            ->add('message', TextareaType::class,[
                'label' => 'Message : ',
                'attr' => [
                    'class' => 'contact-area'
                ]
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn-send'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // 'data_class' => User::class,
        ]);
    }
}

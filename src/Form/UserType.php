<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom :'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom :'
            ])
            ->add('username', TextType::class, [
                'label' => 'Votre pseudo (ou nom d\'utilisateur) :'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre adresse email :'
            ])
            ->add('password', RepeatedType::class, [
                'first_options' => ['label' => 'Votre mot de passe :'],
                'second_options' => ['label' => 'Confirmation de votre mot de passe :'],
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

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
use Symfony\Component\Security\Core\Security;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $edit_user = false;
        if ($options['action_type'] == "edit_user") $edit_user = true;
        
        $edit_admin = false;
        if ($options['action_type'] == "edit_admin") $edit_admin = true;
        

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
            ->add('roles', CollectionType::class, [
                'entry_type'   => ChoiceType::class,
                'entry_options'  => [
                    'label' => false,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => [
                        'Admin' => 'ADMIN',
                        'Super admin' => 'SUPER_ADMIN',
                        'User' => 'USER'
                    ],
                ],
            ])
            ->add('password', RepeatedType::class, [
                'first_options' => ['label' => 'Votre mot de passe :'],
                'second_options' => ['label' => 'Confirmation de votre mot de passe :'],
            ])
            ->add('save', SubmitType::class);

            if ($edit_user) $builder->remove('roles');
            if ($edit_admin) $builder->remove('password');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'action_type' => null,
        ]);
    }
}

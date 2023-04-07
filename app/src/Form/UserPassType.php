<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserPassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('currentpassword', PasswordType::class, [
                'label' => 'Сurrent password',
                'invalid_message' => 'Wrong password.',
                'required' => true,
                'constraints' => [
                    new Length(['min' => 5]),
                    new NotBlank([
                        'message' => 'Please enter your current password',
                    ]),
                ],
            ])
            ->add('newpassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'first_options' => ['label' => 'New Password'],
                'second_options' => ['label' => 'Confirm Password'],
                'required' => true,
                'constraints' => [
                    new Length(['min' => 5]),
                    new NotBlank([
                        'message' => 'Please enter a new password',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // 'data_class' => User::class,
        ]);
    }
}

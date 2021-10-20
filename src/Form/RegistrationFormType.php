<?php

namespace App\Form;

use App\Entity\Inscrit;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',TextType::class, [
                'invalid_message' => 'Le champs doit correspondre à une chaine de caractères',
                'label' => 'Email'])

            ->add('prenom', TextType::class, [
                'invalid_message' => 'Le champs doit correspondre à une chaine de caractères',
                'label' => 'Prenom'
            ])
            ->add('nom', TextType::class, [
                'invalid_message' => 'Le champs doit correspondre à une chaine de caractères',
                'label' => 'Nom'
            ])
            ->add('adresse_postale', TextType::class, [
                'invalid_message' => 'Le champs doit correspondre à une chaine de caractères',
                'label' => 'Adresse Postale'
            ])
            ->add('date_naissance', DateTimeType::class, [
                'invalid_message' => 'Le champs doit correspondre à une date',
                'label' => 'Date de naissance',
                'date_format' => 'dMy',
                'years' => range(date('Y') - 50, date('Y'))
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir au moins 8 caratères, 1 lettre majuscule, 1 minuscule et 1 chiffre',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex('^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}^')
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscrit::class,
        ]);
    }
}

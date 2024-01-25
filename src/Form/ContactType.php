<?php

namespace App\Form;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Asset;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'label_attr' => ['class' => 'font-weight-bold'],
                'attr' => [
                    'class' => 'font-weight-bold',
                    'placeholder' => 'Merci de saisir votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                'label_attr' => ['class' => 'font-weight-bold'],
                'attr' => [
                    'class' => 'font-weight-bold',
                    'placeholder' => 'Merci de saisir votre nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                'label_attr' => ['class' => 'font-weight-bold'],
                'attr' => [
                    'class' => 'font-weight-bold',
                    'placeholder' => 'Merci de saisir votre adresse email',
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'L\'adresse email ne peut pas être vide.',
                    ]),
                    new Assert\Email([
                        'message' => 'L\'adresse email "{{ value }}" n\'est pas valide.',
                        'mode' => 'strict',
                    ]),
                    // Ajoutez d'autres contraintes au besoin
                ],

            ])
            ->add('subject', TextType::class, [
                'label' => 'Sujet',
                'label_attr' => ['class' => 'font-weight-bold'],
                'attr' => [
                    'class' => 'font-weight-bold',
                    'placeholder' => 'Merci de saisir l\'objet de votre demande'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre demande',
                'label_attr' => ['class' => 'font-weight-bold'],
                'attr' => [
                    'class' => 'font-weight-bold',
                    'placeholder' => 'En quoi puis-je vous aider ?'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn btn-info btn-block'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}

<?php

namespace Invest\TrainingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegisterType extends AbstractType {

    public function getName() {
        return 'register form';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Imię i nazwisko'
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Email',
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Email()
                )
            ))
            ->add('sex', ChoiceType::class, array(
                'label' => 'Płeć',
                'choices' => array(
                    'Mężczyzna' => 'm',
                    'Kobieta' => 'k'
                ),
                'expanded' => true
            ))
            ->add('birthdate', BirthdayType::class, array(
                'label' => 'Data urodzenia',
                'placeholder' => '--',
                'empty_data' => NULL
            ))
            ->add('country', CountryType::class, array(
                'label' => 'Kraj',
                'placeholder' => '--',
                'empty_data' => NULL
            ))
            ->add('course', ChoiceType::class, array(
                'label' => 'Kurs',
                'placeholder' => '--',
                'choices' => array(
                    'Kurs podstawowy' => 'basic',
                    'Analiza techniczna' => 'at',
                    'Analiza fundamentalna' => 'af',
                    'Kurs zaawansowany' => 'master'
                )
            ))
            ->add('invest', ChoiceType::class, array(
                'label' => 'Inwestycje',
                'choices' => array(
                    'Akcje' => 'a',
                    'Obligacje' => 'o',
                    'Forex' => 'f',
                    'ETF' => 'etf'
                ),
                'expanded' => true,
                'multiple' => true
            ))
            ->add('comments', TextareaType::class, array(
                'label' => 'Dodatkowy komentarz',
            ))
            ->add('paymentFile', FileType::class, array(
                'label' => 'Potwierdzenie zapłaty'
            ))
            ->add('rules', CheckboxType::class, array(
                    'label' => 'Akceptuje regulamin szkolenia',
                    'mapped' => false
                )
            )
            ->add('save', SubmitType::class, array(
                'label' => 'Zapisz',
            ));
    }
}
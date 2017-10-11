<?php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vihuvac\Bundle\RecaptchaBundle\Form\Type\VihuvacRecaptchaType;
use Vihuvac\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstName', TextType::class, array('label' => 'Prénom'))
        ->add('lastName', TextType::class, array('label' => 'Nom'))
        ->add('naturalist', CheckboxType::class, array(
            'label'    => 'Naturaliste',
            'required' => false,
        ))
        ->add('newsletter', CheckboxType::class, array(
            'label'    => 'S\'inscrire à la newsletter',
            'required' => false,
        ))
        ->add('recaptcha', VihuvacRecaptchaType::class,
            array(
                "mapped"      => false,
                "constraints" => array(
                    new RecaptchaTrue()
                )
            )
        );
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

}

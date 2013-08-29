<?php

namespace Dacorp\CoreBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Doctrine\ORM\EntityRepository;

class DefaultRegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email', 'email')
            ->add('birthdate', 'birthday');
    }

    public function getName()
    {
        return 'user_registration_form';
    }

}
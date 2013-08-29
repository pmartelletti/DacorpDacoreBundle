<?php

namespace Dacorp\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('location','text',array('label'=>'form.label.location'))
            ->add('street', 'text', array('label' => 'form.label.street'))
            ->add('streetNr', 'text', array('label' => 'form.label.street-no'))
            ->add('zipcode', 'number', array('label' => 'form.label.zipcode'));
    }

    public function getName()
    {
        return 'address_form';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dacorp\CoreBundle\Entity\Address'
        ));
    }

}

<?php

namespace Dacorp\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class DacorpMediaType extends AbstractType
{
 
public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('editId','hidden',array('data'=>$options['editId'], 'attr' => array('sm-role' => 'edit-id')))
            ->add('existingFiles','hidden',array('data'=>$options['existingFiles'], 'attr' => array('sm-role' => 'existing-files')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        
        $resolver->setRequired(array(
            'editId',
            'existingFiles'
        ));
    }


    public function getName()
    {
        return 'form_dacorp_media';
    }

}
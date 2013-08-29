<?php

namespace Dacorp\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TypeheadType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $attr = $options['attr'];
        $builder
            ->setAttribute('source',  $attr['source'])
            ->setAttribute('items', $attr['items'])
            ->setAttribute('placeholder', $attr['placeholder']);
        
        //$transformer = new TypeheadTransformer();
        //$builder->addModelTransformer($transformer);

    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {

        $view
            ->set('source',  $form->getAttribute('source'))
            ->set('items', $form->getAttribute('items'))
            ->set('placeholder', $form->getAttribute('placeholder'));
    }

    public function getDefaultOptions(array $options)
    {

        return array(
            'source'  => '[]',
            'items' => 5,
            'placeholder' => ''
        );
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'compound' => false,
        ));
    }

    public function getName() { return 'typehead'; }

    public function getParent() { return 'field'; }

}
?>

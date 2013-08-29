<?php

namespace Dacorp\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Mopa\Bundle\BootstrapBundle\Navbar\NavbarFormInterface;

class SearchFormType extends AbstractType implements NavbarFormInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAttribute('render_fieldset', false)
            ->setAttribute('label_render', false)
            ->setAttribute('show_legend', false)
            ->add('search', 'text', array(
                'attr' => array(
                    'placeholder' => "search",
                    'class' => "input-medium search-query",
                    'pull' => 'pull-right'
                )
            ))
        ;
    }

    public function getName()
    {
        return 'search';
    }

    /**
     * To implement NavbarFormTypeInterface
     */
    public function getRoute()
    {
        return "homepage"; # return here the name of the route the form should point to
    }

}

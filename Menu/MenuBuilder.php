<?php

namespace Dacorp\CoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Mopa\Bundle\BootstrapBundle\Navbar\AbstractNavbarMenuBuilder;

class MenuBuilder extends AbstractNavbarMenuBuilder {
    protected $factory;

    /**
     * Container
     * @var type
     */
    protected $container;
    protected $translator;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, Container $container) {
        $this->container = $container;
        $this->factory = $factory;
        $this->translator = $container->get('translator');
    }

    public function createRightNavbarMenu() {
        $menu = $this->createNavbarMenuItem();
        $menu->setChildrenAttribute('class', 'nav pull-right settings-dropdown');

        //Add a dropdown for settings
        $dropdownSett = $this->createDropdownMenuItem(
            $menu, $this->translator->trans('routename.settings'), true, array('icon' => 'user icon-white'), array('label' => '')
        );

        $dropdownSett->addChild(
            $this->translator->trans('routename.show_own_profile'), array('route' => 'show_own_profile')
        );
        $dropdownSett->addChild(
            $this->translator->trans('routename.edit_own_profile'), array('route' => 'edit_own_profile')
        );

        //Add an icon to logout
        $menu->addChild(
            $this->translator->trans('routename.fos_user_security_logout'), array('route' => 'fos_user_security_logout',
                'label' => '<i class="icon-off icon-white"></i>',
                'extras' => array(
                    'safe_label' => true
                ))
        );

        return $menu;
    }

    public function createLeftNavbarMenu() {
        $menu = $this->createNavbarMenuItem();
        $menu->setChildrenAttribute('class', 'nav pull-left left-menu');
        $menu->addChild($this->translator->trans('navbar.mainlink.latest'), array(
            'route' => 'dacorp_picture_list',
            'routeParameters' => array('listFilter' => 'latest','order'=>'DESC')));
        $menu->addChild($this->translator->trans('navbar.mainlink.popular'), array(
            'route' => 'dacorp_picture_list',
            'routeParameters' => array('listFilter' => 'nbVoteUp','order'=>'DESC')));
        $menu->addChild($this->translator->trans('navbar.upload-button'), array('route' => 'dacorp_picture_create'));
        return $menu;
    }

    public function createLangNavbarMenu() {
        $menu = $this->createNavbarMenuItem();
        $menu->setChildrenAttribute('class', 'nav pull-right');

        //Add a dropdown to switch languages
        $currLang = $this->container->get('session')->get('_locale', $this->container->getParameter('locale'));
        $available_langs = $this->container->getParameter('available_langs');

        $dropdownLang = $this->createDropdownMenuItem(
            $menu, $currLang, true, array('icon' => 'flag icon-white'), array()
        );

        //create the childs
        foreach ($available_langs as $ilang) {
            if ($ilang != $currLang)
                $dropdownLang->addChild(
                    $ilang, array('route' => 'change_lang',
                        'routeParameters' => array('newlang' => $ilang))
                );
        }

        return $menu;
    }

}
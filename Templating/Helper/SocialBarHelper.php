<?php

namespace Dacorp\CoreBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;

class SocialBarHelper extends Helper
{
    protected $templating;

    public function __construct(EngineInterface $templating)
    {
        $this->templating  = $templating;
    }


    public function socialButtons($parameters)
    {
        return $this->templating->render('DacorpCoreBundle:Widgets:socialButtons.html.twig', $parameters);
    }

    public function facebookButton($parameters)
    {
        return $this->templating->render('DacorpCoreBundle:Widgets:facebookButton.html.twig', $parameters);
    }

    public function twitterButton($parameters)
    {
        return $this->templating->render('DacorpCoreBundle:Widgets:twitterButton.html.twig', $parameters);
    }

    public function googlePlusButton($parameters)
    {
        return $this->templating->render('DacorpCoreBundle:Widgets:googlePlusButton.html.twig', $parameters);
    }

    public function pinterestButton($parameters)
    {
        return $this->templating->render('DacorpCoreBundle:Widgets:pinterestButton.html.twig', $parameters);
    }

    public function getName()
    {
        return 'socialButtons';
    }
}
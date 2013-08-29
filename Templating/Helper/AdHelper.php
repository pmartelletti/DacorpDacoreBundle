<?php

namespace Dacorp\CoreBundle\Templating\Helper;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class AdHelper extends Helper
{
    /**
     * @var \Symfony\Component\Templating\EngineInterface
     */
    protected $templating;

    /**
     * @var \Symfony\Component\DomCrawler\Crawler
     */
    protected $adsRepository;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    public function __construct(EngineInterface $templating,Container $container)
    {
        $this->templating  = $templating;

        $this->container = $container;

//        $configDirectories = array($filename);
//        $locator = new FileLocator($configDirectories);
//        $adXmlFile = $locator->locate('adsrepository.xml', null, false);

        $this->adsRepository = new Crawler();
        $kernel = $this->container->get('kernel');
        $path = $kernel->locateResource('@DacorpCoreBundle/Resources/config/adsrepository.xml');
        $this->adsRepository->addXmlContent(file_get_contents($path));

    }


    public function getAdSense($parameters)
    {
        //=
        $render_parameters['size']=$parameters['size'];
        $render_parameters['adContent']=htmlspecialchars_decode($this->adsRepository->filter('ad_'.$parameters['size'])->text());
        $render_parameters['adContentBack']=$this->adsRepository->filter('ad_'.$parameters['size'].'_back')->text();
        return $this->templating->render('DacorpCoreBundle:Widgets:adSense.html.twig', $render_parameters);
    }

    public function getName()
    {
        return 'adHelpers';
    }
}
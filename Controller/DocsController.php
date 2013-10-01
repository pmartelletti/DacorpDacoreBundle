<?php

namespace Dacorp\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DocsController extends Controller
{
    
    public function readMeAction() {
        $filePath = $this->get('kernel')->getRootDir() . "/../README.md";
        $text = file_get_contents($filePath);
        $html = $this->container->get('markdown.parser')->transformMarkdown($text);
        return $this->render('DacorpCoreBundle:Docs:readme.html.twig', array("readme" => $html ));
    }

    public function readMeDacorpAction() {
        $kernel = $this->get('kernel');
        $filePath = $kernel->locateResource('@DacorpCoreBundle/README.md');
        $text = file_get_contents($filePath);
        $html = $this->container->get('markdown.parser')->transformMarkdown($text);
        return $this->render('DacorpCoreBundle:Docs:readme.html.twig', array("readme" => $html ));
    }
    
}

<?php

namespace Dacorp\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DocsController extends Controller
{
    
    public function readmeAction() {
        $file = $this->get('kernel')->getRootDir() . "/../README.md";
        $text = file_get_contents($file);
        $html = $this->container->get('markdown.parser')->transformMarkdown($text);
        return $this->render('DacorpCoreBundle:Docs:readme.html.twig', array("readme" => $html ));
    }
    
}

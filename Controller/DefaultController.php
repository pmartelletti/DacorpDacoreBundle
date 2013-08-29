<?php

namespace Dacorp\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DacorpCoreBundle:Default:index.html.twig');
    }

    public function home2Action()
    {
        /* Important, may be the main redirection */
        $securityContext = $this->get('security.context');

        // redirect to home if user is already logged in
        if ($securityContext->isGranted('ROLE_AUTHENTICATED')) {
            return $this->render('DacorpCoreBundle::home.html.twig');
        }
        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        return $this->render('DacorpCoreBundle:User:register.html.twig', array(
                'csrf_token' => $csrfToken
            )
        );
    }

    public function switchLanguageAction($newlang)
    {
        //$this->get('request')->setLocale($newlang);
        $this->get('session')->set('_locale', $newlang);

        $referer_url = $this->get('request')->headers->get('referer');
        if ($referer_url != null) {
            return $this->redirect($referer_url);
        } else {
            return $this->redirect($this->generateUrl('apps'));
        }
    }

}

<?php

/* Listener to take care of the locale
 * -> https://github.com/symfony/symfony/blob/master/UPGRADE-2.1.md#httpfoundation-1
 *
 */

namespace Dacorp\CoreBundle\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Doctrine\ORM\EntityManager;


class EndOfRequestListener implements EventSubscriberInterface
{

    /** @var \Symfony\Component\Security\Core\SecurityContext */
    private $context;

    /** @var \Doctrine\ORM\EntityManager */
    private $em;

    /** @var \Symfony\Component\HttpFoundation\Session\Session */
    private $session;

    private $container;

    /**
     * Constructor
     *
     * @param SecurityContext $context
     * @param Doctrine        $doctrine
     */
    public function __construct(SecurityContext $context, EntityManager $em, Session $session, Container $container)
    {
        $this->context = $context;
        $this->em = $em;
        $this->session = $session;
        $this->container = $container;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        //Flush the manager once for all request
        $this->em->flush();
    }

    static public function getSubscribedEvents()
    {
        return array(
            // must be registered before the default Locale listener
            KernelEvents::REQUEST => array(array('onKernelResponse', 17)),
        );
    }

}
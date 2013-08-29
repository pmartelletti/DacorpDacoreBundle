<?php

namespace Dacorp\CoreBundle\Services;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;

class SessionManager
{

    /**
     * Container
     * @var type
     */
    protected $container;

    /**
     * Session
     * @var \Symfony\Component\HttpFoundation\Session\Session
     */
    private $session;

    /**
     * EntityManager
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct(Session $session, Container $container, EntityManager $em)
    {
        $this->em = $em;
        $this->session = $session;
        $this->container = $container;
    }

}
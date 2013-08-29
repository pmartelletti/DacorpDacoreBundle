<?php

namespace Dacorp\CoreBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class ContentManager
{

    /**
     * Holds the Doctrine entity manager for database interaction
     * @var EntityManager
     */
    protected $em;

    /**
     * Entity-specific repo, useful for finding entities, for example
     * @var EntityRepository
     */
    protected $repo;

    /**
     * The Fully-Qualified Class Name for our entity
     * @var string
     */
    protected $class;

    /**
     * Container
     * @var type
     */
    protected $container;

    public function __construct(EntityManager $em, Container $container, $class)
    {
        $this->em = $em;
        $this->class = $class;
        $this->repo = $em->getRepository($class);
        $this->container = $container;
    }

    /**
     * @return Comment
     */
    public function create()
    {
        $class = $this->class;
        $content = new $class();

        return $content;
    }

    public function saveChanges()
    {
        $this->em->flush();
    }

    public function delete($content)
    {
        $this->em->remove($content);
        $this->saveChanges();
    }

}
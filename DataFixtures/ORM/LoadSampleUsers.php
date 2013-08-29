<?php

namespace Dacorp\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadSampleUsers implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
//
//        $userManager = $this->container
//            ->get('dacorp.user.manager');
//
//        $lameUserArray = array(
//            array('prout', 'prout', 'arnaud', 'nimes'),
//            array('remi', 'remi', 'Harry', 'Potter'),
//        );
//
//
////will be killed someday
//        foreach ($lameUserArray as $user) {
//            $createdUser = $userManager->createUser();
//            $createdUser->setUsername($user['0']);
//            $createdUser->setEmail($user['0'] . '@popolipopo.com');
//            $createdUser->setPlainPassword($user['1']);
//            $createdUser->setFirstName($user['2']);
//            $createdUser->setLastName($user['3']);
//            $createdUser->setEnabled(true);
//            $userManager->updateUser($createdUser, true);
//        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }

}
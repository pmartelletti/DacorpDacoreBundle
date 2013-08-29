<?php

namespace Dacorp\CoreBundle\Services;

//use FOS\UserBundle\Model\UserManager as UM

use Dacorp\CoreBundle\Entity\User;
use Dacorp\CoreBundle\Entity\UserStat;
use FOS\UserBundle\Doctrine\UserManager as BaseUserManager;
use FOS\UserBundle\Model\UserInterface;

class UserManager extends BaseUserManager
{
    /**
     * Returns an empty user instance
     *
     * @return UserInterface
     */
    public function createUser()
    {
        /* @var User $user */
        $user = parent::createUser();

        $userStat = new UserStat();
        $user->setUserStat($userStat);
        return $user;
    }

}
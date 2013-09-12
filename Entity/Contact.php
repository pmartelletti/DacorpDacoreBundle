<?php
// src/Dacorp/CoreBundle/Entity.php

namespace Dacorp\CoreBundle\Entity;

use Mremi\ContactBundle\Entity\Contact as BaseContact;

class Contact extends BaseContact
{
    /**
     * @var integer
     */
    protected $id;
}
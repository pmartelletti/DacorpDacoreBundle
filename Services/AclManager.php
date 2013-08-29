<?php

namespace Dacorp\CoreBundle\Services;

use Problematic\AclManagerBundle\Domain\AclManager as ProblematicAclManager;

/**
 * Extending the Default Problematic AclManager, mainly ACL related actions, no business logic
 */
class AclManager extends ProblematicAclManager
{
    public function addArrayObjectPermission($domainObjects, $mask, $securityIdentity = null)
    {
        foreach ($domainObjects as $domainObject) {
            $this->addPermission($domainObject, $mask, $securityIdentity, 'object', false);
        }
    }

}
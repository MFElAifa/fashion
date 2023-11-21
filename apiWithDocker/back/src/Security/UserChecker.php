<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\Exception\AccountStatusException;

class UserChecker implements UserCheckerInterface
{
    /**
     * Checks the user account before authentication.
     *
     * @throws AccountStatusException
     */
    public function checkPreAuth(UserInterface $user)
    {
        if(!$user instanceof User){
            return;
        }

        if(!in_array(User::ROLE_EMPLOYE, $user->getRoles())){
            throw new DisabledException();
        }
    }

    /**
     * Checks the user account after authentication.
     *
     * @throws AccountStatusException
     */
    public function checkPostAuth(UserInterface $user)
    {
        
    }
}
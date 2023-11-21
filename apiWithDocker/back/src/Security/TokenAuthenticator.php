<?php

namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\ExpiredTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authenticator\JWTAuthenticator;

class TokenAuthenticator extends JWTAuthenticator
{
    /**
     * Loads the user to authenticate.
     *
     * @param array                 $payload      The token payload
     * @param string                $identity     The key from which to retrieve the user "identifier"
     */
    protected function loadUser(array $payload, string $identity): UserInterface
    {
        $user = parent::loadUser($payload, $identity);
        
        dd($user);
        // if($user->getPasswordChangedDate() && 
        //             $payload['iat'] < $user->getPasswordChangedDate()){
        //     throw new ExpiredTokenException();                        
        // }

        return $user;
    }
}
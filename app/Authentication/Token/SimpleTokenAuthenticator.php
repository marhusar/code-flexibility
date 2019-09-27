<?php

namespace App\Authentication\Token;

use App\User\Contract\User;
use App\User\Entity\UserEntity;

class SimpleTokenAuthenticator implements TokenAuthenticator
{
    /**
     * @return User
     */
    public function getUser(): User
    {
        $user = new UserEntity();
        $user->setId(2);
        $user->setName('mobile app user');

        return $user;
    }
}

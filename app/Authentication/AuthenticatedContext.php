<?php

namespace App\Authentication;

use App\User\Contract\User;
use App\User\Entity\UserEntity;

class AuthenticatedContext implements Guard
{
    /**
     * @return null|User
     */
    public static function getAuthenticatedUser(): ?User
    {
        $user = new UserEntity();

        $user->setId(1);
        $user->setName('Currently logged user');

        return $user;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        $user = new UserEntity();

        $user->setId(1);
        $user->setName('Currently logged user');

        return $user;
    }
}

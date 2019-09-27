<?php

namespace App\Authentication\Token;

use App\User\Contract\User;

interface TokenAuthenticator
{
    /**
     * @return User
     */
    public function getUser(): User;
}

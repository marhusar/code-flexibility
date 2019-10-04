<?php

namespace App\Authentication;

use App\User\Contract\User;

interface UserAuthenticator
{
    public function getUser(): ?User;
}

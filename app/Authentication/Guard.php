<?php

namespace App\Authentication;

use App\User\Contract\User;

interface Guard
{
    /**
     * @return User|null
     */
    public function getUser(): ?User;
}

<?php

namespace App\Post\Policy;

use App\Post\Contract\Post;
use App\User\Contract\User;

interface PostReadPolicy
{
    /**
     * @param User $user
     * @param Post $post
     *
     * @return bool
     */
    public function canReadPost(User $user, Post $post): bool;
}

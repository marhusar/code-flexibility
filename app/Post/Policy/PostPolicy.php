<?php

namespace App\Post\Policy;

use App\Post\Contract\Post;
use App\User\Contract\User;

class PostPolicy implements PostReadPolicy
{
    /**
     * @param User $user
     * @param Post $post
     *
     * @return bool
     */
    public static function canUserReadPost(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @param Post $post
     *
     * @return bool
     */
    public function canReadPost(User $user, Post $post): bool
    {
        return false;
    }
}

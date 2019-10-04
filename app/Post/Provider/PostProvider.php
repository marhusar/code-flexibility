<?php

namespace App\Post\Provider;

use App\Post\View\PostView;
use App\User\Contract\User;

interface PostProvider
{
    public function getPost(int $postId, User $user): PostView;
}

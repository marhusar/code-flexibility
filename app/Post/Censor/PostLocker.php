<?php

namespace App\Post\Censor;

use App\Post\Contract\Post;
use App\Post\View\PostView;

interface PostLocker
{
    /**
     * @param Post $post
     *
     * @return PostView
     */
    public function getCensoredPostView(Post $post): PostView;
}

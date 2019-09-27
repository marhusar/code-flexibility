<?php

namespace App\Post\Repository;

use App\Post\Contract\Post;

interface PostRepository
{
    /**
     * @param int $postId
     *
     * @return Post
     */
    public function getPost(int $postId): Post;
}

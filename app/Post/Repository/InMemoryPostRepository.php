<?php

namespace App\Post\Repository;

use App\Post\Contract\Post;
use App\Post\Entity\PostEntity;

class InMemoryPostRepository implements PostRepository
{
    /**
     * @param int $postId
     *
     * @return Post
     */
    public function getPost(int $postId): Post
    {
        $post = new PostEntity();
        $post->setId($postId);
        $post->setTitle('Hello adventurer');
        $post->setBody('Once upon time there was a kingdom far far away in beautiful country called Westeros');

        return $post;
    }
}

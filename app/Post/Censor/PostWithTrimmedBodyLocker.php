<?php

namespace App\Post\Censor;

use App\Post\Contract\Post;
use App\Post\View\PostView;

class PostWithTrimmedBodyLocker implements PostLocker
{
    /**
     * @param Post $post
     *
     * @return PostView
     */
    public function getCensoredPostView(Post $post): PostView
    {
        $body = $post->getBody();

        $trimmedBody = substr($body, 0, 10);
        $trimmedBody .= '... THIS CONTENT IS LOCKED';

        return new PostView($post->getTitle(), $trimmedBody);
    }

    /**
     * @param Post $post
     *
     * @return PostView
     */
    public static function getCensoredView(Post $post): PostView
    {
        $body = $post->getBody();

        $trimmedBody = substr($body, 0, 10);
        $trimmedBody .= '... THIS CONTENT IS LOCKED';

        return new PostView($post->getTitle(), $trimmedBody);
    }
}

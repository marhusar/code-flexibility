<?php

namespace App\Post\Provider;

use App\Post\Censor\PostLocker;
use App\Post\Policy\PostReadPolicy;
use App\Post\Repository\PostRepository;
use App\Post\View\PostView;
use App\User\Contract\User;

class CensoredPostProvider implements PostProvider
{
    /** @var PostRepository */
    private $postRepository;

    /** @var PostReadPolicy */
    private $postPolicy;

    /** @var PostLocker */
    private $postLocker;

    /**
     * @param PostRepository $postRepository
     * @param PostReadPolicy $postPolicy
     * @param PostLocker     $postLocker
     */
    public function __construct(PostRepository $postRepository, PostReadPolicy $postPolicy, PostLocker $postLocker)
    {
        $this->postRepository = $postRepository;
        $this->postPolicy     = $postPolicy;
        $this->postLocker     = $postLocker;
    }

    public function getPost(int $postId, User $user): PostView
    {
        $post = $this->postRepository->getPost($postId);

        $postView = new PostView($post->getTitle(), $post->getBody());

        if ($this->postPolicy->canReadPost($user, $post) === false) {
            $postView = $this->postLocker->getCensoredPostView($post);
        }

        return $postView;
    }
}

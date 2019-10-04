<?php

namespace App\Http\Action;

use App\Authentication\Guard;
use App\Authentication\UserAuthenticator;
use App\Post\Censor\PostLocker;
use App\Post\Policy\PostReadPolicy;
use App\Post\Provider\PostProvider;
use App\Post\Repository\PostRepository;
use App\Post\View\PostView;

class ShowPostHandler
{
    /** @var PostProvider */
    private $postProvider;

    /** @var UserAuthenticator */
    private $authenticator;

    /**
     * @param PostProvider      $postProvider
     * @param UserAuthenticator $authenticator
     */
    public function __construct(PostProvider $postProvider, UserAuthenticator $authenticator)
    {
        $this->postProvider  = $postProvider;
        $this->authenticator = $authenticator;
    }

    /**
     * @param int $postId
     *
     * @return PostView
     */
    public function showPost(int $postId): PostView
    {
        $user = $this->authenticator->getUser();

        return $this->postProvider->getPost($postId, $user);
    }
}

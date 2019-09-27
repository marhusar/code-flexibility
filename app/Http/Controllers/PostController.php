<?php

namespace App\Http\Controllers;

use App\Authentication\AuthenticatedContext;
use App\Post\Censor\PostWithTrimmedBodyLocker;
use App\Post\Policy\PostPolicy;
use App\Post\Repository\PostRepository;
use App\Post\View\PostView;

class PostController
{
    /** @var PostRepository */
    private $postRepository;

    /**
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param int $postId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $postId)
    {
        $user = AuthenticatedContext::getAuthenticatedUser();
        $post = $this->postRepository->getPost($postId);

        $postView = new PostView($post->getTitle(), $post->getBody());

        if (PostPolicy::canUserReadPost($user, $post) === false) {
            $postView = PostWithTrimmedBodyLocker::getCensoredView($post);
        }

        return view('post.show', ['post' => $postView]);
    }
}

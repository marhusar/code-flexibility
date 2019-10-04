<?php

namespace App\Http\Controllers;

use App\Http\Action\ShowPostHandler;

class PostController
{
    /** @var ShowPostHandler */
    private $showPostHandler;

    /**
     * @param ShowPostHandler $showPostHandler
     */
    public function __construct(ShowPostHandler $showPostHandler)
    {
        $this->showPostHandler = $showPostHandler;
    }

    /**
     * @param int $postId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $postId)
    {
        $postView = $this->showPostHandler->showPost($postId);

        return view('post.show', ['post' => $postView]);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Action\ShowPostHandler;
use Illuminate\Http\Resources\Json\JsonResource;

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
     * @return false|string
     */
    public function show(int $postId)
    {
        $post = $this->showPostHandler->showPost($postId);

        return new JsonResource((array)$post);
    }
}

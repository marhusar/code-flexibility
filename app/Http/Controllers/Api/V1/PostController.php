<?php

namespace App\Http\Controllers\Api\V1;

use App\Authentication\Token\TokenAuthenticator;
use Illuminate\Http\Resources\Json\JsonResource;

class PostController
{
    /** @var TokenAuthenticator */
    private $tokenAuthenticator;

    /**
     * @param TokenAuthenticator $tokenAuthenticator
     */
    public function __construct(TokenAuthenticator $tokenAuthenticator)
    {
        $this->tokenAuthenticator = $tokenAuthenticator;
    }

    /**
     * @param int $postId
     *
     * @return false|string
     */
    public function show(int $postId)
    {
        $user = $this->tokenAuthenticator->getUser();

        $post = null;

        return new JsonResource((array)$post);
    }
}

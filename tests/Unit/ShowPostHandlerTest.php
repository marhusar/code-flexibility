<?php

namespace Tests\Unit;

use App\Authentication\Token\TokenAuthenticator;
use App\Http\Action\ShowPostHandler;
use App\Post\Provider\PostProvider;
use App\Post\View\PostView;
use App\User\Contract\User;
use PHPUnit\Framework\TestCase;

class ShowPostHandlerTest extends TestCase
{
    public function testCanGetPostView()
    {
        $postView = new PostView('title', 'body');

        $postProvider = $this->getMockBuilder(PostProvider::class)->getMock();
        $postProvider->method('getPost')->willReturn($postView);

        $user = $this->getMockBuilder(User::class)->getMock();

        $authenticator = $this->getMockBuilder(TokenAuthenticator::class)->getMock();
        $authenticator->method('getUser')
            ->willReturn($user);

        $handler = new ShowPostHandler($postProvider, $authenticator);
        $result = $handler->showPost(12345);

        $this->assertSame($postView, $result);
    }
}

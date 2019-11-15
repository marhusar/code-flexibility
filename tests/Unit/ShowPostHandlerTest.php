<?php

namespace Tests\Unit;

use App\Authentication\AuthenticatedContext;
use App\Authentication\Token\TokenAuthenticator;
use App\Http\Action\ShowPostHandler;
use App\Post\Censor\PostWithTrimmedBodyLocker;
use App\Post\Contract\Post;
use App\Post\Policy\PostPolicy;
use App\Post\Provider\CensoredPostProvider;
use App\Post\Provider\PostProvider;
use App\Post\Repository\PostRepository;
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
        $result  = $handler->showPost(12345);

        $this->assertSame($postView, $result);
    }
    
    public function testCanGetCensoredPost()
    {
        $postId = 789;

        $post = $this->getMockBuilder(Post::class)->getMock();
        $post->method('getTitle')
            ->willReturn('This is title');
        $post->method('getBody')
            ->willReturn('this is body of post');

        $postRepository = $this->getMockBuilder(PostRepository::class)->getMock();
        $postRepository
            ->method('getPost')
            ->with($this->equalTo($postId))
            ->willReturn($post);

        $repository = $postRepository;
        $policy = new PostPolicy();
        $locker = new PostWithTrimmedBodyLocker();

        $authenticator = new AuthenticatedContext();
        $provider = new CensoredPostProvider($repository, $policy, $locker);


        $handler = new ShowPostHandler($provider, $authenticator);

        $result = $handler->showPost(789);

        $this->assertInstanceOf(PostView::class, $result);
    }

}

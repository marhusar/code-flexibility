<?php

namespace Tests\Unit;

use App\Post\Censor\PostLocker;
use App\Post\Contract\Post;
use App\Post\Policy\PostReadPolicy;
use App\Post\Provider\CensoredPostProvider;
use App\Post\Repository\PostRepository;
use App\Post\View\PostView;
use App\User\Contract\User;
use PHPUnit\Framework\TestCase;

class PostProviderTest extends TestCase
{
    public function testCanGetNotCensoredPost()
    {
        $post = $this->getMockBuilder(Post::class)->getMock();
        $post->method('getTitle')
            ->willReturn('This is title');
        $post->method('getBody')
            ->willReturn('this is body of post');

        $postRepository = $this->getMockBuilder(PostRepository::class)->getMock();
        $postRepository->expects($this->once())
            ->method('getPost')
            ->willReturn($post);

        $postPolicy = $this->getMockBuilder(PostReadPolicy::class)->getMock();
        $postPolicy->method('canReadPost')
            ->willReturn(true);

        $locker = $this->getMockBuilder(PostLocker::class)->getMock();

        $postProvider = new CensoredPostProvider($postRepository, $postPolicy, $locker);

        $user = $this->getMockBuilder(User::class)->getMock();

        $result = $postProvider->getPost(12345, $user);

        $this->assertInstanceOf(PostView::class, $result);
    }

    public function testGetCensoredPostWithoutRights()
    {
        $post = $this->getMockBuilder(Post::class)->getMock();
        $post->method('getTitle')
            ->willReturn('This is title');
        $post->method('getBody')
            ->willReturn('this is body of post');

        $postRepository = $this->getMockBuilder(PostRepository::class)->getMock();
        $postRepository->expects($this->once())
            ->method('getPost')
            ->willReturn($post);

        $postPolicy = $this->getMockBuilder(PostReadPolicy::class)->getMock();
        $postPolicy->method('canReadPost')
            ->willReturn(false);

        $postView = new PostView('This is title', 'this is censored body');

        $locker = $this->getMockBuilder(PostLocker::class)->getMock();
        $locker->method('getCensoredPostView')
            ->willReturn($postView);

        $postProvider = new CensoredPostProvider($postRepository, $postPolicy, $locker);

        $user = $this->getMockBuilder(User::class)->getMock();
        $result = $postProvider->getPost(12345, $user);

        $this->assertSame('this is censored body', $result->getBody());
    }
}

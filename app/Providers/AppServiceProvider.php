<?php

namespace App\Providers;

use App\Authentication\AuthenticatedContext;
use App\Authentication\Guard;
use App\Authentication\Token\SimpleTokenAuthenticator;
use App\Authentication\Token\TokenAuthenticator;
use App\Http\Action\CensoredPostProvider;
use App\Http\Action\ShowPostHandler;
use App\Http\Controllers\PostController;
use App\Post\Policy\PostPolicy;
use App\Post\Policy\PostReadPolicy;
use App\Post\Censor\PostLocker;
use App\Post\Censor\PostWithTrimmedBodyLocker;
use App\Post\Provider\PostProvider;
use App\Post\Repository\InMemoryPostRepository;
use App\Post\Repository\PostRepository;
use Illuminate\Support\ServiceProvider;
use function foo\func;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Guard::class, AuthenticatedContext::class);
        $this->app->bind(PostReadPolicy::class, PostPolicy::class);
        $this->app->bind(PostRepository::class, InMemoryPostRepository::class);
        $this->app->bind(PostLocker::class, PostWithTrimmedBodyLocker::class);
        $this->app->bind(TokenAuthenticator::class, SimpleTokenAuthenticator::class);
        $this->app->bind(PostProvider::class, \App\Post\Provider\CensoredPostProvider::class);

        $handler = new ShowPostHandler(
            $this->app->make(PostProvider::class),
            $this->app->make(Guard::class)
        );

        $this->app->when(PostController::class)
            ->needs(ShowPostHandler::class)
            ->give(function () use ($handler) {
                return $handler;
            });

        $apiHandler = new ShowPostHandler(
            $this->app->make(PostProvider::class),
            $this->app->make(TokenAuthenticator::class)
        );

        $this->app->when(\App\Http\Controllers\Api\V1\PostController::class)
            ->needs(ShowPostHandler::class)
            ->give(function () use ($apiHandler) {
                return $apiHandler;
            });
    }
}

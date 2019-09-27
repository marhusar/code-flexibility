<?php

namespace App\Providers;

use App\Authentication\AuthenticatedContext;
use App\Authentication\Guard;
use App\Authentication\Token\SimpleTokenAuthenticator;
use App\Authentication\Token\TokenAuthenticator;
use App\Post\Policy\PostPolicy;
use App\Post\Policy\PostReadPolicy;
use App\Post\Censor\PostLocker;
use App\Post\Censor\PostWithTrimmedBodyLocker;
use App\Post\Repository\InMemoryPostRepository;
use App\Post\Repository\PostRepository;
use Illuminate\Support\ServiceProvider;

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
    }
}

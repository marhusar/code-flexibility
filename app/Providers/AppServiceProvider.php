<?php

namespace App\Providers;

use App\Country\Repository\Contract\CountryRepository;
use App\Illuminate\Request;
use App\Product\Collection;
use App\Product\Entity\ProductEntity;
use App\Product\Provider\InMemoryProductProvider;
use App\Request\RouteParameterProvider;
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
        $products = [];

        $product1 = new ProductEntity();
        $product1->setId(1);
        $product1->setName('Antivirus');

        $product2 = new ProductEntity();
        $product2->setId(2);
        $product2->setName('Disk cleaner');

        $products[] = $product1;
        $products[] = $product2;

        $this->app->when(InMemoryProductProvider::class)
            ->needs(Collection::class)
            ->give(function () use ($products) {
                return new Collection($products);
            });

        $this->app->bind(CountryRepository::class, \App\Country\Repository\CountryRepository::class);
        $this->app->bind(RouteParameterProvider::class, Request::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

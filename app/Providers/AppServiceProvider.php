<?php

namespace App\Providers;

use App\Product\Collection;
use App\Product\Entity\ProductEntity;
use App\Product\Provider\InMemoryProductProvider;
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

<?php

namespace App\Product\Provider;

use App\Country\Entity\CountryEntity;
use App\Product\Collection;
use App\Product\Entity\ProductEntity;

class InMemoryProductProvider
{
    /** @var Collection */
    private $products;

    /**
     * @param Collection $products
     */
    public function __construct(Collection $products)
    {
        $this->products = $products;
    }

    /**
     * @param CountryEntity $country
     *
     * @return Collection
     */
    public function getProductsForCountry(CountryEntity $country): Collection
    {
        return $this->products;
    }
}

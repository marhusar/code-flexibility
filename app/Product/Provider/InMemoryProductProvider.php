<?php

namespace App\Product\Provider;

use App\Country\Entity\CountryEntity;
use App\Product\Collection;
use App\Product\Entity\ProductEntity;
use App\Country\Entity\Country;

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
     * @param Country $country
     *
     * @return Collection
     */
    public function getProductsForCountry(Country $country): Collection
    {
        return $this->products;
    }
}

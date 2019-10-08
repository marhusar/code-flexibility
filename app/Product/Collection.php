<?php

namespace App\Product;

use App\Product\Entity\ProductEntity;

class Collection
{
    /** @var array */
    private $products = [];

    /**
     * @param array $products
     */
    public function __construct(array $products = [])
    {
        $this->insertValidProductsOnly($products);
    }

    /**
     * @param array $products
     */
    private function insertValidProductsOnly(array $products): void
    {
        foreach ($products as $product) {
            if ($product instanceof ProductEntity) {
                $this->products[] = $product;
            }
        }
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->products;
    }
}

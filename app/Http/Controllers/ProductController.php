<?php

namespace App\Http\Controllers;

use App\Http\Action\ShowProductsHandler;

class ProductController
{
    /** @var ShowProductsHandler */
    private $showProductsHandler;

    /**
     * @param ShowProductsHandler $showProductsHandler
     */
    public function __construct(ShowProductsHandler $showProductsHandler)
    {
        $this->showProductsHandler = $showProductsHandler;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->showProductsHandler->showProducts();

        return view('products.index', ['product_list' => $products->all()]);
    }
}

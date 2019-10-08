<?php

namespace App\Http\Controllers;

use App\Country\Repository\CountryRepository;
use App\Exceptions\InvalidCountryCodeException;
use App\Product\Provider\InMemoryProductProvider;
use Illuminate\Http\Request;
use Mockery\Exception\InvalidCountException;

class ProductController
{
    /** @var Request */
    private $request;

    /** @var  CountryRepository */
    private $countryRepository;

    /** @var InMemoryProductProvider */
    private $productProvider;

    /**
     * @param Request                 $request
     * @param CountryRepository       $countryRepository
     * @param InMemoryProductProvider $productProvider
     */
    public function __construct(
        Request $request,
        CountryRepository $countryRepository,
        InMemoryProductProvider $productProvider
    ) {
        $this->request           = $request;
        $this->countryRepository = $countryRepository;
        $this->productProvider   = $productProvider;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $countryCode = $this->request->route('channel', '');

        $country = $this->countryRepository->query()->where('code', '=', $countryCode)->get();

        if ($country === null) {
            throw new InvalidCountryCodeException($countryCode);
        }

        $products = $this->productProvider->getProductsForCountry($country);

        return view('products.index', ['product_list' => $products->all()]);
    }
}

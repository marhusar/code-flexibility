<?php

namespace App\Http\Action;

use App\Country\Repository\CountryRepository;
use App\Exceptions\InvalidCountryCodeException;
use App\Product\Collection;
use App\Product\Provider\InMemoryProductProvider;
use App\Request\RouteParameterProvider;
use Illuminate\Http\Request;

class ShowProductsHandler
{
    /** @var RouteParameterProvider */
    private $routeParameterProvider;

    /** @var  \App\Country\Repository\Contract\CountryRepository */
    private $countryRepository;

    /** @var InMemoryProductProvider */
    private $productProvider;

    /**
     * @param RouteParameterProvider $routeParameterProvider
     * @param \App\Country\Repository\Contract\CountryRepository $countryRepository
     * @param InMemoryProductProvider $productProvider
     */
    public function __construct(
        RouteParameterProvider $routeParameterProvider,
        \App\Country\Repository\Contract\CountryRepository $countryRepository,
        InMemoryProductProvider $productProvider
    ) {
        $this->routeParameterProvider = $routeParameterProvider;
        $this->countryRepository      = $countryRepository;
        $this->productProvider        = $productProvider;
    }

    /**
     * @return \App\Product\Collection
     */
    public function showProducts(): Collection
    {
        $countryCode = $this->routeParameterProvider->getRouteParameter('channel', '');

        $country = $this->countryRepository->findCountryByCode($countryCode);

        if ($country === null) {
            throw new InvalidCountryCodeException($countryCode);
        }

        return $this->productProvider->getProductsForCountry($country);
    }
}

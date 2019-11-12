<?php

namespace App\Country\Repository\Contract;

use App\Country\Entity\Country;

interface CountryRepository
{
    /**
     * @param string $countryCode
     *
     * @return Country|null
     */
    public function findCountryByCode(string $countryCode): ?Country;
}

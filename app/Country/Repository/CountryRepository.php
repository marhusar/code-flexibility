<?php

namespace App\Country\Repository;

use App\Country\Entity\Country;
use App\ORM\Query;

class CountryRepository implements \App\Country\Repository\Contract\CountryRepository
{
    /**
     * @return Query
     */
    public function query(): Query
    {
        return new Query();
    }

    /**
     * @param string $countryCode
     *
     * @return Country|null
     */
    public function findCountryByCode(string $countryCode): ?Country
    {
        return $this->query()->where('code', '=', $countryCode)->get();
    }
}

<?php

namespace App\Country\Repository;

use App\ORM\Query;

class CountryRepository
{
    /**
     * @return Query
     */
    public function query(): Query
    {
        return new Query();
    }
}

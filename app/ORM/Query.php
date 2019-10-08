<?php

namespace App\ORM;

use App\Country\Entity\CountryEntity;

class Query
{
    /** @var string */
    private $compareTo;

    /**
     * @param string $property
     * @param string $comparision
     * @param string $compareTo
     *
     * @return Query
     */
    public function where(string $property, string $comparision, string $compareTo): Query
    {
        $this->compareTo = $compareTo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->execute();
    }

    /**
     * @return mixed
     */
    private function execute()
    {
        if ($this->compareTo !== 'sk') {
            return null;
        }

        $country = new CountryEntity();
        $country->setId(1);
        $country->setName('Slovakia');
        $country->setCode('sk');

        return $country;
    }
}

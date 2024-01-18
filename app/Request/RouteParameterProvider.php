<?php

namespace App\Request;

interface RouteParameterProvider
{
    /**
     * @param string $name
     * @param null   $default
     *
     * @return null|string
     */
    public function getRouteParameter(string $name, $default = null): ?string;
}

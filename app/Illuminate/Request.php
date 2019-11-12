<?php

namespace App\Illuminate;

use App\Request\RouteParameterProvider;

class Request implements RouteParameterProvider
{
    /** @var \Illuminate\Http\Request */
    private $request;

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $name
     * @param null   $default
     *
     * @return null|string
     */
    public function getRouteParameter(string $name, $default = null): ?string
    {
        return $this->request->route($name, $default);
    }
}

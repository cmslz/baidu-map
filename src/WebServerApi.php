<?php

namespace Cmslz\BaiduMap;

use Cmslz\BaiduMap\Exception\MapException;
use Cmslz\BaiduMap\Exception\ServerException;
use Cmslz\BaiduMap\WebServeApi\PlaceApi;
use GuzzleHttp\Exception\GuzzleException;

class WebServerApi
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function placeApi(): PlaceApi
    {
        return new PlaceApi($this->request);
    }

}
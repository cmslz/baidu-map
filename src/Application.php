<?php

namespace Cmslz\BaiduMap;

use GuzzleHttp\Client;

class Application
{
    protected string $key;
    protected Client $client;
    protected array $defaultConfig = [
        'client' => [
            'base_uri' => 'https://api.map.baidu.com',
        ]
    ];

    protected array $config;

    public function __construct(string $key, array $config = [])
    {
        $this->key = $key;
        $clientConfig = array_merge($this->defaultConfig['client'], $config['_client'] ?? []);
        $config = array_merge($this->defaultConfig, $config);
        unset($config['_client'], $config['client']);
        $this->config = $config;
        $this->client = new Client($clientConfig);
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * https://lbs.qq.com/service/webService/webServiceGuide/webServiceOverview
     * @return WebServerApi
     */
    public function webServerApi(): WebServerApi
    {
        return new WebServerApi((new Request($this->key, $this->client, $this->config)));
    }
}
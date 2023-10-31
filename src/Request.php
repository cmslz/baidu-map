<?php

namespace Cmslz\BaiduMap;

use Cmslz\BaiduMap\Exception\MapException;
use Cmslz\BaiduMap\Exception\ServerException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

/**
 * 请求类
 */
class Request
{
    protected string $key;

    protected Client $client;

    protected Response $response;

    protected array $config = [];

    protected array $headers = [];

    public function __construct(string $key, Client $client, array $config = [])
    {
        $this->key = $key;
        $this->client = $client;
        $this->config = $config;
    }

    private function formatPath(string $path, array $data = []): string
    {
        $data = array_merge($data, ['ak' => $this->key]);
        $query = parse_url_query($path);
        $query['query'] = array_merge($query['query'], $data);
        return $query['path'] . '?' . http_build_query($query['query']);
    }

    /**
     * 发送get请求
     * @param string $path
     * @param array $data
     * @param array $config
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    public function get(string $path, array $data = [], array $config = []): Response
    {
        return $this->beforeResponse(
            $this->client->request('get', $this->formatPath($path, $data), [
                'headers' => $this->headers
            ]),
            $config
        );
    }

    /**
     * 发送post请求
     * @param string $path
     * @param array $data
     * @param array $config
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    public function post(string $path, array $data = [], array $config = []): Response
    {
        return $this->beforeResponse(
            $this->client->request('post', $this->formatPath($path), [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json',
                    ...$this->headers
                ]
            ]),
            $config
        );
    }

    /**
     * 请求后前置处理response
     * @param GuzzleResponse $response
     * @param array $config
     * @return Response
     * @throws MapException
     * @throws ServerException
     */
    protected function beforeResponse(GuzzleResponse $response, array $config = []): Response
    {
        $this->response = new Response($response, $config['result_type'] ?? Response::RESULT_JSON);
        $result = $this->response->getResult();
        if (!is_array($result)) {
            $result = @json_decode($result, JSON_UNESCAPED_UNICODE);
        }
        if (is_array($result)) {
            $this->checkResponse($result);
        }
        return $this->response();
    }

    /**
     * @param array $result
     * @return void
     * @throws ServerException
     */
    protected function checkResponse(array $result): void
    {
        if (isset($result['infocode']) && $result['infocode'] !== '10000') {
            throw new ServerException($result['info']);
        } elseif (isset($result['errcode']) && $result['errcode'] !== 0) {
            throw new ServerException($result['errmsg']);
        }
    }

    /**
     * 获取相应
     * @return Response
     */
    private function response(): Response
    {
        return $this->response;
    }
}
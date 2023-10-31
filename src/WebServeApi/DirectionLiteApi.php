<?php

namespace Cmslz\BaiduMap\WebServeApi;

use Cmslz\BaiduMap\Request;

/**
 * 轻量级路线规划服务 V1.0
 * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/webservice-lwrouteplanapi
 */
class DirectionLiteApi
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 驾车路线规划
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/webservice-lwrouteplanapi/dirve
     * @param string $origin
     * @param string $destination
     * @param array $options
     * @return \Cmslz\BaiduMap\Response
     * @throws \Cmslz\BaiduMap\Exception\MapException
     * @throws \Cmslz\BaiduMap\Exception\ServerException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function driving(string $origin, string $destination, array $options = []): \Cmslz\BaiduMap\Response
    {
        return $this->request->get('/directionlite/v1/driving',
            array_merge(compact('origin', 'destination'), $options));
    }

    /**
     * 骑行路线规划
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/webservice-lwrouteplanapi/cycling
     * @param string $origin
     * @param string $destination
     * @param array $options
     * @return \Cmslz\BaiduMap\Response
     * @throws \Cmslz\BaiduMap\Exception\MapException
     * @throws \Cmslz\BaiduMap\Exception\ServerException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function riding(string $origin, string $destination, array $options = []): \Cmslz\BaiduMap\Response
    {
        return $this->request->get('/directionlite/v1/riding',
            array_merge(compact('origin', 'destination'), $options));
    }

    /**
     * 步行路线规划
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/webservice-lwrouteplanapi/walk
     * @param string $origin
     * @param string $destination
     * @param array $options
     * @return \Cmslz\BaiduMap\Response
     * @throws \Cmslz\BaiduMap\Exception\MapException
     * @throws \Cmslz\BaiduMap\Exception\ServerException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function walking(string $origin, string $destination, array $options = []): \Cmslz\BaiduMap\Response
    {
        return $this->request->get('/directionlite/v1/walking',
            array_merge(compact('origin', 'destination'), $options));
    }

    /**
     * 公交路线规划
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/webservice-lwrouteplanapi/walk
     * @param string $origin
     * @param string $destination
     * @param array $options
     * @return \Cmslz\BaiduMap\Response
     * @throws \Cmslz\BaiduMap\Exception\MapException
     * @throws \Cmslz\BaiduMap\Exception\ServerException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function transit(string $origin, string $destination, array $options = []): \Cmslz\BaiduMap\Response
    {
        return $this->request->get('/directionlite/v1/transit',
            array_merge(compact('origin', 'destination'), $options));
    }

    /**
     * 摩托车路线规划
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/webservice-direction/motorcycle
     * @param string $origin
     * @param string $destination
     * @param array $options
     * @return \Cmslz\BaiduMap\Response
     * @throws \Cmslz\BaiduMap\Exception\MapException
     * @throws \Cmslz\BaiduMap\Exception\ServerException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function motorcycle(string $origin, string $destination, array $options = []): \Cmslz\BaiduMap\Response
    {
        return $this->request->get('/direction/v2/motorcycle',
            array_merge(compact('origin', 'destination'), $options));
    }

    /**
     * 货车路线规划
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/direction-api-truck-base
     * @param string $origin
     * @param string $destination
     * @param array $options
     * @return \Cmslz\BaiduMap\Response
     * @throws \Cmslz\BaiduMap\Exception\MapException
     * @throws \Cmslz\BaiduMap\Exception\ServerException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function truck(string $origin, string $destination, array $options = []): \Cmslz\BaiduMap\Response
    {
        return $this->request->get('logistics_direction/v1/truck',
            array_merge(compact('origin', 'destination'), $options));
    }
}
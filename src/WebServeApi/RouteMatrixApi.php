<?php

namespace Cmslz\BaiduMap\WebServeApi;

use Cmslz\BaiduMap\Exception\MapException;
use Cmslz\BaiduMap\Exception\ServerException;
use Cmslz\BaiduMap\Request;
use Cmslz\BaiduMap\Response;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 批量算路
 * @link https://lbsyun.baidu.com/faq/api?title=webapi/routchtout
 */
class RouteMatrixApi
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 驾车批量算路
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/routchtout-drive
     * @param string $origins 纬度,经度。示例：40.056878,116.30815|40.063597,116.364973
     * @param string $destinations 纬度,经度。示例：40.056878,116.30815|40.063597,116.364973
     * @param array $options
     * @return Response
     * @throws MapException
     * @throws ServerException
     * @throws GuzzleException
     */
    public function driving(string $origins, string $destinations, array $options = []): Response
    {
        return $this->request->get('/routematrix/v2/driving',
            array_merge(compact('origins', 'destinations'), $options));
    }

    /**
     * 驾车批量算路
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/routchtout-ride
     * @param string $origins 纬度,经度。示例：40.056878,116.30815|40.063597,116.364973
     * @param string $destinations 纬度,经度。示例：40.056878,116.30815|40.063597,116.364973
     * @param array $options
     * @return Response
     * @throws MapException
     * @throws ServerException
     * @throws GuzzleException
     */
    public function riding(string $origins, string $destinations, array $options = []): Response
    {
        return $this->request->get('/routematrix/v2/riding',
            array_merge(compact('origins', 'destinations'), $options));
    }

    /**
     * 步行批量算路
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/routchtout-walk
     * @param string $origins 纬度,经度。示例：40.056878,116.30815|40.063597,116.364973
     * @param string $destinations 纬度,经度。示例：40.056878,116.30815|40.063597,116.364973
     * @param array $options
     * @return Response
     * @throws MapException
     * @throws ServerException
     * @throws GuzzleException
     */
    public function walking(string $origins, string $destinations, array $options = []): Response
    {
        return $this->request->get('/routematrix/v2/walking',
            array_merge(compact('origins', 'destinations'), $options));
    }

    /**
     * 摩托车批量算路
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/routchtout-motor
     * @param string $origins 纬度,经度。示例：40.056878,116.30815|40.063597,116.364973
     * @param string $destinations 纬度,经度。示例：40.056878,116.30815|40.063597,116.364973
     * @param array $options
     * @return Response
     * @throws MapException
     * @throws ServerException
     * @throws GuzzleException
     */
    public function motorcycle(string $origins, string $destinations, array $options = []): Response
    {
        return $this->request->get('/routematrix/v2/walking',
            array_merge(compact('origins', 'destinations'), $options));
    }

    /**
     * 货车批量算路
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/route-matrix-truck/matrixtruck
     * @param string $origins 纬度,经度。示例：40.056878,116.30815|40.063597,116.364973
     * @param string $destinations 纬度,经度。示例：40.056878,116.30815|40.063597,116.364973
     * @param array $options
     * @return Response
     * @throws MapException
     * @throws ServerException
     * @throws GuzzleException
     */
    public function truck(string $origins, string $destinations, array $options = []): Response
    {
        return $this->request->get('/logistics_routematrix/v1/truck',
            array_merge(compact('origins', 'destinations'), $options));
    }
}
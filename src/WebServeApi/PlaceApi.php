<?php

namespace Cmslz\BaiduMap\WebServeApi;

use Cmslz\BaiduMap\Exception\MapException;
use Cmslz\BaiduMap\Exception\ServerException;
use Cmslz\BaiduMap\Request;
use Cmslz\BaiduMap\Response;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 地点检索服务（又名Place API）是一类Web API接口服务；服务提供多种场景的地点（POI）检索功能，包括城市检索、圆形区域检索、多边形区域检索。开发者可通过接口获取地点（POI）基础或详细地理信息。
 * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/webservice-placeapi
 */
class PlaceApi
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 检索
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/webservice-placeapi/district
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    private function _search(array $options = []): Response
    {
        return $this->request->get('/place/v2/search', $options);
    }

    /**
     * 区域检索
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/webservice-placeapi/district
     * @param string $query 检索关键字 天安门、美食
     * @param string $region 检索行政区划区域 北京、131（北京的code）、海淀区、全国，等
     * @param array $options
     * @return Response
     * @throws MapException
     * @throws ServerException
     * @throws GuzzleException
     */
    public function searchByRegion(string $query, string $region, array $options = []): Response
    {
        return $this->_search(array_merge(compact('query', 'region'), $options));
    }

    /**
     * 原型检索
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/webservice-placeapi/circle
     * @param string $query 检索关键字 天安门、美食
     * @param string $location 圆形区域检索中心点，不支持多个点 38.76623,116.43213 lat<纬度>,lng<经度>
     * @param array $options
     * @return Response
     * @throws MapException
     * @throws ServerException
     * @throws GuzzleException
     */
    public function searchByBounds(string $query, string $location, array $options = []): Response
    {
        return $this->_search(array_merge(compact('query', 'location'), $options));
    }

    /**
     * 获取POI图片
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/place-poiImg
     * @param bool $photo_show
     * @param int $scope
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    public function searchByPhoto(bool $photo_show = true, int $scope = 1, array $options = []): Response
    {
        return $this->_search(array_merge(compact('photo_show', 'scope'), $options));
    }

    /**
     * 获取POI营业状态
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/place-poiStatus
     * @param string $output 输出格式为json或者xml
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    public function searchByStatus(string $output = 'json', array $options = []): Response
    {
        return $this->_search(array_merge(compact('output'), $options));
    }

    /**
     * 地点详情
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/webservice-placeapi/detail
     * @param string $uid poi的uid uid的集合，最多可以传入10个uid，多个uid之间用英文逗号分隔。
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    public function detail(string $uid, array $options = []): Response
    {
        return $this->request->get('/place/v2/detail', array_merge(
            compact('uid'),
            $options
        ));
    }

    /**
     * 地点输入提示
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/place-suggestion-api
     * @param string $q poi的uid uid的集合，最多可以传入10个uid，多个uid之间用英文逗号分隔。
     * @param string $region
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    public function suggestion(string $q, string $region, array $options = []): Response
    {
        return $this->request->get('/place/v2/suggestion', array_merge(
            compact('q', 'region'),
            $options
        ));
    }

    /**
     * 地理编码
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/webservice-geocoding-base
     * @param string $address
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    public function geocoding(string $address, array $options = []): Response
    {
        return $this->request->get('/place/v2/suggestion', array_merge(
            compact('address'),
            $options
        ));
    }

    /**
     * 全球逆地理编码
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/webservice-geocoding-abroad
     * @param string $location
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    public function reverseGeocoding(string $location, array $options = []): Response
    {
        return $this->request->get('/reverse_geocoding/v3', array_merge(
            compact('location'),
            $options
        ));
    }

    /**
     * 坐标转换
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/changeposition-base
     * @param string $coords 需转换的源坐标，多组坐标以“;”分隔（经度，纬度） 114.21892734521,29.575429778924
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    public function geoConv(string $coords, array $options = []): Response
    {
        return $this->request->get('/geoconv/v1/', array_merge(
            compact('coords'),
            $options
        ));
    }

    /**
     * 地址解析聚合
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/address_analyze
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    private function _addressAnalyzer(array $options = []): Response
    {
        return $this->request->get('/address_analyzer/v1', $options);
    }

    /**
     * 地址解析聚合
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/address_analyze
     * @param string $address 需要解析的地址文本
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    public function addressAnalyzer(string $address, array $options = []): Response
    {
        return $this->_addressAnalyzer(array_merge(compact('address'), $options));
    }

    /**
     * 地址解析聚合
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/address_analyze
     * @param int $addr_unify 是否返回地址归一结果
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    public function addressAnalyzerByUnify(int $addr_unify = 1, array $options = []): Response
    {
        return $this->_addressAnalyzer(array_merge(compact('addr_unify'), $options));
    }

    /**
     * 地址解析聚合
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/address_analyze
     * @param int $addr_verify 是否返回地址归一结果
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    public function addressAnalyzerByVerify(int $addr_verify = 1, array $options = []): Response
    {
        return $this->_addressAnalyzer(array_merge(compact('addr_verify'), $options));
    }

    /**
     * 城乡类型判别
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/address_recognize-base
     * @param string $address 需要解析的地址
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    public function reCog(string $address, array $options = []): Response
    {
        return $this->request->get('/api_recog_address/v1/recog', array_merge(
            compact('address'),
            $options
        ));
    }

    /**
     * 时区服务
     * @link https://lbsyun.baidu.com/faq/api?title=webapi/guide/timezone-base
     * @param float $location 需查询时区的位置坐标(纬度、经度）,当前仅支持全球陆地坐标查询，海域坐标暂不支持。39.934,116.387
     * @param array $options
     * @return Response
     * @throws GuzzleException
     * @throws MapException
     * @throws ServerException
     */
    public function timezone(float $location, array $options = []): Response
    {
        return $this->request->get('/timezone/v1', array_merge(
            compact('location'),
            $options
        ));
    }
}
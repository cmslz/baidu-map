<?php

namespace Cmslz\BaiduMap\WebServeApi;

use Cmslz\BaiduMap\Exception\MapException;
use Cmslz\BaiduMap\Exception\ServerException;
use Cmslz\BaiduMap\Request;
use Cmslz\BaiduMap\Response;
use GuzzleHttp\Exception\GuzzleException;

class MapApi
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 高清地图
     * @link https://lbsyun.baidu.com/faq/api?title=static/heightStatic
     * @param array $options
     * @return \Cmslz\BaiduMap\Response
     * @throws \Cmslz\BaiduMap\Exception\MapException
     * @throws \Cmslz\BaiduMap\Exception\ServerException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function _staticImage(array $options = []): \Cmslz\BaiduMap\Response
    {
        return $this->request->get('/staticimage/v2', $options);
    }

    /**
     * 高清地图
     * @link https://lbsyun.baidu.com/faq/api?title=static/heightStatic
     * @param array $options
     * @return \Cmslz\BaiduMap\Response
     * @throws \Cmslz\BaiduMap\Exception\MapException
     * @throws \Cmslz\BaiduMap\Exception\ServerException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function staticImage(array $options = []): \Cmslz\BaiduMap\Response
    {
        return $this->_staticImage($options);
    }

    /**
     * 添加点/标签
     * @link https://lbsyun.baidu.com/faq/api?title=static/markerStatic
     * @param string $url 自定义icon的地址，图片格式目前仅支持png32的。设置自定义图标标注时，忽略以上三个属性，只设置该属性且该属性前增加-1，如markerStyles=-1,https://api.map.baidu.com/images/marker_red.png 图标大小需小于5k，超过该值会导致加载不上图标的情况发生,图标的尺寸应小于256*256
     * @param string $label 可以为[0-9]、[A-Z]，不指定时显示A。
     * @param string $color Color = [0x000000, 0xffffff]或使用css定义的颜色表。black 0x000000 silver 0xC0C0C0 gray 0x808080 white 0xFFFFFF maroon 0x800000 red 0xFF0000 purple 0x800080 fuchsia 0xFF00FF green 0x008000 lime 0x00FF00 olive 0x808000 yellow 0xFFFF00 navy 0x000080 blue 0x0000FF teal 0x008080 aqua 0x00FFFF
     * @param array $options
     * @return Response
     * @throws MapException
     * @throws ServerException
     * @throws GuzzleException
     */
    public function staticImageByTag(
        string $url,
        string $label = '',
        string $color = '',
        array $options = []
    ): \Cmslz\BaiduMap\Response {
        $options['label'] = $label;
        $options['color'] = $color;
        return $this->_staticImage(array_merge(compact('url'), $options));
    }
}
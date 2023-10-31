<?php

if (!function_exists('parse_url_query')) {
    /**
     * 格式化链接参数
     * @param string $url
     * @return array
     */
    function parse_url_query(string $url): array
    {
        $parseData = parse_url($url);
        $queryStr = $parseData['query'] ?? '';
        $params = explode('&', $queryStr);
        $query = [];
        foreach ($params as $item) {
            $tmp = explode('=', $item, 2);
            if (!empty($tmp[0])) {
                $query[$tmp[0]] = $tmp[1] ?? null;
            }
        }
        return [
            'path' => $parseData['path'] ?? '',
            'query' => $query,
            'scheme' => $parseData['scheme'] ?? null,
            'host' => $parseData['host'] ?? null,
        ];
    }
}

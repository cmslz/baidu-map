<?php

namespace Cmslz\BaiduMap;

use Cmslz\BaiduMap\Exception\MapException;

/**
 * 响应类
 */
class Response implements \ArrayAccess
{
    protected \GuzzleHttp\Psr7\Response $response;
    protected mixed $result;
    public const RESULT_JSON = 1;
    public const RESULT_STRING = 2;
    public const RESULT_ORIGINAL = 3;

    /**
     * @throws MapException
     */
    public function __construct(\GuzzleHttp\Psr7\Response $response, int $resultType = self::RESULT_JSON)
    {
        $this->response = $response;
        $this->result = match ($resultType) {
            self::RESULT_JSON => json_decode((string)$this->rawData(), JSON_UNESCAPED_UNICODE),
            self::RESULT_STRING => (string)$this->rawData(),
            self::RESULT_ORIGINAL => $this->rawData(),
            default => throw new MapException('result type error'),
        };
    }

    protected function rawData(): \Psr\Http\Message\StreamInterface
    {
        return $this->response->getBody();
    }

    public function toArray(): array
    {
        return $this->result['result'];
    }

    public function getResult(): mixed
    {
        return $this->result;
    }

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->result);
    }

    public function offsetGet(mixed $offset)
    {
        return $this->result[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->result[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->result[$offset]);
    }
}
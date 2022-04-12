<?php

namespace Surpaimb\WeChat\MiniProgram\UrlLink;

use Surpaimb\WeChat\Kernel\BaseClient;
use Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException;
use Surpaimb\WeChat\Kernel\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Url Scheme
 *
 * Class Client
 * @package Surpaimb\WeChat\MiniProgram\UrlLink
 */
class Client extends BaseClient
{
    /**
     * 获取小程序 URL Link
     *
     * @param  array  $param
     * @return array|Collection|object|ResponseInterface|string
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     */
    public function generate(array $param = [])
    {
        return $this->httpPostJson('wxa/generate_urllink', $param);
    }
}

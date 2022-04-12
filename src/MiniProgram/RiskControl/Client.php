<?php

namespace Surpaimb\WeChat\MiniProgram\RiskControl;

use Surpaimb\WeChat\Kernel\BaseClient;
use Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException;
use Surpaimb\WeChat\Kernel\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * 安全风控
 *
 * Class Client
 * @package Surpaimb\WeChat\MiniProgram\RiskControl
 */
class Client extends BaseClient
{
    /**
     * 获取用户的安全等级
     *
     * @param  array  $params
     * @return array|Collection|object|ResponseInterface|string
     *
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function getUserRiskRank(array $params)
    {
        return $this->httpPostJson('wxa/getuserriskrank', $params);
    }
}

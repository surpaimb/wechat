<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Payment\Contract;

use Surpaimb\WeChat\Payment\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author tianyong90 <412039588@qq.com>
 */
class Client extends BaseClient
{
    /**
     * entrust official account.
     *
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function web(array $params)
    {
        $params['appid'] = $this->app['config']->app_id;

        return $this->safeRequest('papay/entrustweb', $params);
    }

    /**
     * entrust app.
     *
     * @param array $params
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function app(array $params)
    {
        $params['appid'] = $this->app['config']->app_id;

        return $this->safeRequest('papay/preentrustweb', $params);
    }

    /**
     * entrust html 5.
     *
     * @param array $params
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function h5(array $params)
    {
        $params['appid'] = $this->app['config']->app_id;

        return $this->safeRequest('papay/h5entrustweb', $params);
    }

    /**
     * apply papay.
     *
     * @param array $params
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function apply(array $params)
    {
        $params['appid'] = $this->app['config']->app_id;

        return $this->safeRequest('pay/pappayapply', $params);
    }

    /**
     * delete papay contrace.
     *
     * @param array $params
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(array $params)
    {
        $params['appid'] = $this->app['config']->app_id;

        return $this->safeRequest('papay/deletecontract', $params);
    }
}

<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\OfficialAccount\WiFi;

use Surpaimb\WeChat\Kernel\BaseClient;

/**
 * Class CardClient.
 *
 * @author her-cat <i@her-cat.com>
 */
class CardClient extends BaseClient
{
    /**
     * Set shop card coupon delivery information.
     *
     * @param array $data
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function set(array $data)
    {
        return $this->httpPostJson('bizwifi/couponput/set', $data);
    }

    /**
     * Get shop card coupon delivery information.
     *
     * @param int $shopId
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $shopId = 0)
    {
        return $this->httpPostJson('bizwifi/couponput/get', ['shop_id' => $shopId]);
    }
}

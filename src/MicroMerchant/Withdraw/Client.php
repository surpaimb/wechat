<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\MicroMerchant\Withdraw;

use Surpaimb\WeChat\MicroMerchant\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author   liuml  <liumenglei0211@163.com>
 * @DateTime 2019-05-30  14:19
 */
class Client extends BaseClient
{
    /**
     * Query withdrawal status.
     *
     * @param string $date
     * @param string $subMchId
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function queryWithdrawalStatus($date, $subMchId = '')
    {
        return $this->safeRequest('fund/queryautowithdrawbydate', [
            'date' => $date,
            'sign_type' => 'HMAC-SHA256',
            'nonce_str' => uniqid('micro'),
            'sub_mch_id' => $subMchId ?: $this->app['config']->sub_mch_id,
        ]);
    }

    /**
     * Re-initiation of withdrawal.
     *
     * @param string $date
     * @param string $subMchId
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function requestWithdraw($date, $subMchId = '')
    {
        return $this->safeRequest('fund/reautowithdrawbydate', [
            'date' => $date,
            'sign_type' => 'HMAC-SHA256',
            'nonce_str' => uniqid('micro'),
            'sub_mch_id' => $subMchId ?: $this->app['config']->sub_mch_id,
        ]);
    }
}

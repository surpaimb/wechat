<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Payment\Reverse;

use Surpaimb\WeChat\Payment\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * Reverse order by out trade number.
     *
     * @param string $outTradeNumber
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function byOutTradeNumber(string $outTradeNumber)
    {
        return $this->reverse($outTradeNumber, 'out_trade_no');
    }

    /**
     * Reverse order by transaction_id.
     *
     * @param string $transactionId
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function byTransactionId(string $transactionId)
    {
        return $this->reverse($transactionId, 'transaction_id');
    }

    /**
     * Reverse order.
     *
     * @param string $number
     * @param string $type
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function reverse(string $number, string $type)
    {
        $params = [
            'appid' => $this->app['config']->app_id,
            $type => $number,
        ];

        return $this->safeRequest($this->wrap('secapi/pay/reverse'), $params);
    }
}

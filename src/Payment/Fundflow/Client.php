<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Payment\Fundflow;

use Surpaimb\WeChat\Kernel\Http\StreamResponse;
use Surpaimb\WeChat\Payment\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * Download fundflow history as a table file.
     *
     * @param string $date
     * @param string $type
     * @param array  $options
     *
     * @return array|\Surpaimb\WeChat\Kernel\Http\Response|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $date, string $type = 'Basic', $options = [])
    {
        $params = [
            'appid' => $this->app['config']->app_id,
            'bill_date' => $date,
            'account_type' => $type,
            'sign_type' => 'HMAC-SHA256',
            'nonce_str' => uniqid('micro'),
        ];
        $options = array_merge(
            [
                'cert' => $this->app['config']->get('cert_path'),
                'ssl_key' => $this->app['config']->get('key_path'),
            ],
            $options
        );
        $response = $this->requestRaw('pay/downloadfundflow', $params, 'post', $options);

        if (0 === strpos($response->getBody()->getContents(), '<xml>')) {
            return $this->castResponseToType($response, $this->app['config']->get('response_type'));
        }

        return StreamResponse::buildFromPsrResponse($response);
    }
}

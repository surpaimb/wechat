<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Work\Chat;

use Surpaimb\WeChat\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author XiaolonY <xiaolony@hotmail.com>
 */
class Client extends BaseClient
{
    /**
     * Get chat.
     *
     * @param string $chatId
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function get(string $chatId)
    {
        return $this->httpGet('cgi-bin/appchat/get', ['chatid' => $chatId]);
    }

    /**
     * Create chat.
     *
     * @param array $data
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $data)
    {
        return $this->httpPostJson('cgi-bin/appchat/create', $data);
    }

    /**
     * Update chat.
     *
     * @param string $chatId
     * @param array  $data
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(string $chatId, array $data)
    {
        return $this->httpPostJson('cgi-bin/appchat/update', array_merge(['chatid' => $chatId], $data));
    }

    /**
     * Send a message.
     *
     * @param array $message
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(array $message)
    {
        return $this->httpPostJson('cgi-bin/appchat/send', $message);
    }
}

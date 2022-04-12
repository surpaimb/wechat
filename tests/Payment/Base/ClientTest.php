<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\Payment\Base;

use Surpaimb\WeChat\Payment\Application;
use Surpaimb\WeChat\Payment\Base\Client;
use Surpaimb\WeChat\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testPay()
    {
        $app = new Application(['app_id' => 'mock-appid']);

        $client = $this->mockApiClient(Client::class, ['pay'], $app)->makePartial();

        $order = [
            'appid' => 'mock-appid',
            'foo' => 'bar',
        ];

        $client->expects()->request('pay/micropay', $order)->andReturn('mock-result');
        $this->assertSame('mock-result', $client->pay($order));
    }

    public function testAuthCodeToOpenid()
    {
        $app = new Application(['app_id' => 'mock-appid']);

        $client = $this->mockApiClient(Client::class, 'authCodeToOpenId', $app)->makePartial();

        $client->expects()->request('tools/authcodetoopenid', [
            'appid' => 'mock-appid',
            'auth_code' => 'foo',
            ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->authCodeToOpenid('foo'));
    }
}

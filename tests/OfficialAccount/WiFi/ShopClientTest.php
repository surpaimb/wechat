<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OfficialAccount\WiFi;

use Surpaimb\WeChat\OfficialAccount\WiFi\ShopClient;
use Surpaimb\WeChat\Tests\TestCase;

class ShopClientTest extends TestCase
{
    public function testGet()
    {
        $client = $this->mockApiClient(ShopClient::class);

        $client->expects()
            ->httpPostJson('bizwifi/shop/get', ['shop_id' => 100])
            ->andReturn('mock-result');

        $this->assertSame('mock-result', $client->get(100));
    }

    public function testList()
    {
        $client = $this->mockApiClient(ShopClient::class);

        $client->expects()
            ->httpPostJson('bizwifi/shop/list', ['pageindex' => 1, 'pagesize' => 20])
            ->andReturn('mock-result');

        $this->assertSame('mock-result', $client->list(1, 20));
    }

    public function testUpdate()
    {
        $client = $this->mockApiClient(ShopClient::class);

        $client->expects()
            ->httpPostJson('bizwifi/shop/update', ['shop_id' => 100, 'foo' => 'bar'])
            ->andReturn('mock-result');

        $this->assertSame('mock-result', $client->update(100, ['foo' => 'bar']));
    }

    public function testClearDevice()
    {
        $client = $this->mockApiClient(ShopClient::class);

        $client->expects()
            ->httpPostJson('bizwifi/shop/clean', ['shop_id' => 100, 'ssid' => 'mock-ssid'])
            ->andReturn('mock-result');

        $this->assertSame('mock-result', $client->clearDevice(100, 'mock-ssid'));
    }
}

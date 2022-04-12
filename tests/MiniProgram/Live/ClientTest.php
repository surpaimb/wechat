<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\MiniProgram\Live;

use Surpaimb\WeChat\MiniProgram\Live\Client;
use Surpaimb\WeChat\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testGetRooms()
    {
        $client = $this->mockApiClient(Client::class)->makePartial();

        $params = [
            'start' => 0,
            'limit' => 10,
        ];

        $client->expects()->httpPostJson('wxa/business/getliveinfo', $params)->andReturn('mock-result');
        $this->assertSame('mock-result', $client->getRooms());
    }

    public function testGetPlaybacks()
    {
        $client = $this->mockApiClient(Client::class)->makePartial();

        $params = [
            'action' => 'get_replay',
            'room_id' => 1,
            'start' => 0,
            'limit' => 10,
        ];

        $client->expects()->httpPostJson('wxa/business/getliveinfo', $params)->andReturn('mock-result');
        $this->assertSame('mock-result', $client->getPlaybacks(1));
    }
}

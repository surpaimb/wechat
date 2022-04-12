<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\MiniProgram\PhoneNumber;

use Surpaimb\WeChat\MiniProgram\PhoneNumber\Client;
use Surpaimb\WeChat\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testGetUserPhoneNumber()
    {
        $client = $this->mockApiClient(Client::class);

        $client->expects()->httpPostJson('wxa/business/getuserphonenumber', [
            'code' => 'test'
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->getUserPhoneNumber('test'));
    }
}

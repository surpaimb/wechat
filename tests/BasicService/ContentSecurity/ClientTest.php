<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\BasicService\ContentSecurity;

use Surpaimb\WeChat\BasicService\ContentSecurity\Client;
use Surpaimb\WeChat\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testCheckText()
    {
        $client = $this->mockApiClient(Client::class, 'checkText')->shouldAllowMockingProtectedMethods();
        $client->makePartial();

        $client->expects()->httpPostJson('wxa/msg_sec_check', [
            'content' => 'foo',
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->checkText('foo'));
    }

    public function testCheckImage()
    {
        $client = $this->mockApiClient(Client::class, 'checkImage')->shouldAllowMockingProtectedMethods();
        $client->makePartial();

        $imagePath = 'foo';

        $client->expects()->httpUpload('wxa/img_sec_check', [
            'media' => $imagePath,
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->checkImage($imagePath));
    }
}

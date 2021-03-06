<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OfficialAccount\AutoReply;

use Surpaimb\WeChat\OfficialAccount\AutoReply\Client;
use Surpaimb\WeChat\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testCurrent()
    {
        $client = $this->mockApiClient(Client::class);
        $client->expects()->httpGet('cgi-bin/get_current_autoreply_info')->andReturn('mock-result');

        $this->assertSame('mock-result', $client->current());
    }
}

<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\BasicService\Url;

use Surpaimb\WeChat\BasicService\Url\Client;
use Surpaimb\WeChat\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testShorten()
    {
        $client = $this->mockApiClient(Client::class);
        $url = 'http://easywechat.com';
        $client->expects()->httpPostJson('cgi-bin/shorturl', [
            'action' => 'long2short',
            'long_url' => $url,
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->shorten($url));
    }
}

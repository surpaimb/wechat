<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\MiniProgram\Sns;

use Surpaimb\WeChat\Kernel\ServiceContainer;
use Surpaimb\WeChat\MiniProgram\Auth\Client;
use Surpaimb\WeChat\Tests\TestCase;

class AuthTest extends TestCase
{
    public function testGetSessionKey()
    {
        $client = $this->mockApiClient(Client::class, [], new ServiceContainer(['app_id' => 'app-id', 'secret' => 'mock-secret']));

        $client->expects()->httpGet('sns/jscode2session', [
            'appid' => 'app-id',
            'secret' => 'mock-secret',
            'js_code' => 'js-code',
            'grant_type' => 'authorization_code',
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->session('js-code'));
    }
}

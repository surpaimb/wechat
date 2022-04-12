<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OpenWork\MiniProgram;

use Surpaimb\WeChat\Kernel\ServiceContainer;
use Surpaimb\WeChat\OpenWork\MiniProgram\Client;
use Surpaimb\WeChat\OpenWork\SuiteAuth\AccessToken;
use Surpaimb\WeChat\Tests\TestCase;

/**
 * Class Auth.
 */
class ClientTest extends TestCase
{
    public function testGetSessionKey()
    {
        $app = new ServiceContainer(['suite_id' => 'mock-suit-id']);
        $app['suite_access_token'] = \Mockery::mock(AccessToken::class);
        $client = $this->mockApiClient(Client::class, [], $app);

        $client->expects()->httpGet('cgi-bin/service/miniprogram/jscode2session', [
            'js_code' => 'js-code',
            'grant_type' => 'authorization_code',
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->session('js-code'));
    }
}

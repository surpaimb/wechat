<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OpenPlatform\Auth;

use Surpaimb\WeChat\Kernel\ServiceContainer;
use Surpaimb\WeChat\OpenPlatform\Auth\AccessToken;
use Surpaimb\WeChat\OpenPlatform\Auth\VerifyTicket;
use Surpaimb\WeChat\Tests\TestCase;

class AccessTokenTest extends TestCase
{
    public function testGetCredentials()
    {
        $verifyTicket = \Mockery::mock(VerifyTicket::class, function ($mock) {
            $mock->expects()->getTicket()->andReturn('ticket@123456');
        });

        $app = new ServiceContainer([
            'app_id' => 'mock-app-id',
            'secret' => 'mock-secret',
        ], ['verify_ticket' => $verifyTicket]);
        $token = \Mockery::mock(AccessToken::class, [$app])->makePartial()->shouldAllowMockingProtectedMethods();

        $this->assertSame([
            'component_appid' => 'mock-app-id',
            'component_appsecret' => 'mock-secret',
            'component_verify_ticket' => 'ticket@123456',
        ], $token->getCredentials());
    }
}

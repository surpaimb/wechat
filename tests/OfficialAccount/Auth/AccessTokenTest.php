<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OfficialAccount\Auth;

use Surpaimb\WeChat\Kernel\ServiceContainer;
use Surpaimb\WeChat\OfficialAccount\Auth\AccessToken;
use Surpaimb\WeChat\Tests\TestCase;

class AccessTokenTest extends TestCase
{
    public function testGetCredentials()
    {
        $app = new ServiceContainer([
            'app_id' => 'mock-app-id',
            'secret' => 'mock-secret',
        ]);
        $token = \Mockery::mock(AccessToken::class, [$app])->makePartial()->shouldAllowMockingProtectedMethods();

        $this->assertSame([
            'grant_type' => 'client_credential',
            'appid' => 'mock-app-id',
            'secret' => 'mock-secret',
        ], $token->getCredentials());
    }
}

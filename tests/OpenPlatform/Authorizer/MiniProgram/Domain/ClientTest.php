<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OpenPlatform\Authorizer\MiniProgram\Domain;

use Surpaimb\WeChat\Kernel\ServiceContainer;
use Surpaimb\WeChat\OpenPlatform\Authorizer\MiniProgram\Domain\Client;
use Surpaimb\WeChat\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testModify()
    {
        $client = $this->mockApiClient(Client::class, [], new ServiceContainer(['app_id' => 'app-id']));

        $client->expects()->httpPostJson('wxa/modify_domain', ['foo' => 'bar'])->andReturn('mock-result');
        $this->assertSame('mock-result', $client->modify(['foo' => 'bar']));
    }

    public function testSetWebviewDomain()
    {
        $client = $this->mockApiClient(Client::class, [], new ServiceContainer(['app_id' => 'app-id']));

        $client->expects()->httpPostJson('wxa/setwebviewdomain', ['webviewdomain' => ['bar'], 'action' => 'add'])->andReturn('mock-result');
        $this->assertSame('mock-result', $client->setWebviewDomain(['bar']));
    }
}

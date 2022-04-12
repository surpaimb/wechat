<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OfficialAccount\ShakeAround;

use Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException;
use Surpaimb\WeChat\OfficialAccount\Application;
use Surpaimb\WeChat\OfficialAccount\ShakeAround\Client;
use Surpaimb\WeChat\OfficialAccount\ShakeAround\DeviceClient;
use Surpaimb\WeChat\OfficialAccount\ShakeAround\GroupClient;
use Surpaimb\WeChat\OfficialAccount\ShakeAround\MaterialClient;
use Surpaimb\WeChat\OfficialAccount\ShakeAround\RelationClient;
use Surpaimb\WeChat\OfficialAccount\ShakeAround\ShakeAround;
use Surpaimb\WeChat\OfficialAccount\ShakeAround\StatsClient;
use Surpaimb\WeChat\Tests\TestCase;

class ShakeAroundTest extends TestCase
{
    public function testInstances()
    {
        $app = new Application();
        $shakeAround = new ShakeAround($app);

        $this->assertInstanceOf(Client::class, $shakeAround);
        $this->assertInstanceOf(DeviceClient::class, $shakeAround->device);
        $this->assertInstanceOf(GroupClient::class, $shakeAround->group);
        $this->assertInstanceOf(MaterialClient::class, $shakeAround->material);
        $this->assertInstanceOf(RelationClient::class, $shakeAround->relation);
        $this->assertInstanceOf(StatsClient::class, $shakeAround->stats);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('No shake_around service named "foo".', $shakeAround->foo);
    }
}

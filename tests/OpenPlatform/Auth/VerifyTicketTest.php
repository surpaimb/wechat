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

use Surpaimb\WeChat\Kernel\Exceptions\RuntimeException;
use Surpaimb\WeChat\OpenPlatform\Application;
use Surpaimb\WeChat\OpenPlatform\Auth\VerifyTicket;
use Surpaimb\WeChat\Tests\TestCase;
use Psr\SimpleCache\CacheInterface;

class VerifyTicketTest extends TestCase
{
    public function testSetTicket()
    {
        $client = \Mockery::mock(VerifyTicket::class.'[getCache]', [new Application(['app_id' => 'app-id'])], function ($mock) {
            $cache = \Mockery::mock(CacheInterface::class, function ($mock) {
                $key = 'easywechat.open_platform.verify_ticket.app-id';
                $mock->expects()->set($key, 'ticket@654321', 3600)->andReturn(true);
                $mock->expects()->has($key)->andReturn(true);
            });
            $mock->allows()->getCache()->andReturn($cache);
        });

        $this->assertInstanceOf(VerifyTicket::class, $client->setTicket('ticket@654321'));

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Failed to cache verify ticket.');
        $client = \Mockery::mock(VerifyTicket::class.'[getCache]', [new Application(['app_id' => 'app-id'])], function ($mock) {
            $cache = \Mockery::mock(CacheInterface::class, function ($mock) {
                $key = 'easywechat.open_platform.verify_ticket.app-id';
                $mock->expects()->set($key, 'ticket@654321', 3600)->andReturn(false);
                $mock->expects()->has($key)->andReturn(false);
            });
            $mock->allows()->getCache()->andReturn($cache);
        });
        $client->setTicket('ticket@654321');
    }

    public function testGetTicket()
    {
        $client = \Mockery::mock(VerifyTicket::class.'[getCache]', [new Application(['app_id' => 'app-id'])], function ($mock) {
            $cache = \Mockery::mock(CacheInterface::class, function ($mock) {
                $key = 'easywechat.open_platform.verify_ticket.app-id';
                $mock->expects()->get($key)->andReturn('ticket@123456');
            });
            $mock->allows()->getCache()->andReturn($cache);
        });

        $this->assertSame('ticket@123456', $client->getTicket());
    }

    public function testGetTicketAndThrowException()
    {
        $client = \Mockery::mock(VerifyTicket::class.'[getCache]', [new Application(['app_id' => 'app-id'])], function ($mock) {
            $cache = \Mockery::mock(CacheInterface::class, function ($mock) {
                $key = 'easywechat.open_platform.verify_ticket.app-id';
                $mock->expects()->get($key)->andReturn(null);
            });
            $mock->allows()->getCache()->andReturn($cache);
        });

        $this->expectException('Surpaimb\WeChat\Kernel\Exceptions\RuntimeException');
        $this->expectExceptionMessage('Credential "component_verify_ticket" does not exist in cache.');
        $client->getTicket();
    }
}

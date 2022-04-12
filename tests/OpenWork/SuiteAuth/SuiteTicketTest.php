<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OpenWork\SuiteAuth;

use Surpaimb\WeChat\Kernel\Exceptions\RuntimeException;
use Surpaimb\WeChat\OpenWork\Application;
use Surpaimb\WeChat\OpenWork\SuiteAuth\SuiteTicket;
use Surpaimb\WeChat\Tests\TestCase;
use Psr\SimpleCache\CacheInterface;

class SuiteTicketTest extends TestCase
{
    public function testSetTicket()
    {
        $client = \Mockery::mock(SuiteTicket::class.'[getCache]', [new Application(['suite_id' => 'mock-suite-id'])], function ($mock) {
            $cache = \Mockery::mock(CacheInterface::class, function ($mock) {
                $key = 'easywechat.open_work.suite_ticket.mock-suite-id';
                $mock->expects()->set($key, 'mock-suit-ticket@666', 1800)->andReturn(true);
                $mock->expects()->has($key)->andReturn(true);
            });
            $mock->allows()->getCache()->andReturn($cache);
        });

        $this->assertInstanceOf(SuiteTicket::class, $client->setTicket('mock-suit-ticket@666'));
    }

    public function testSetTicketAndThrowException()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Failed to cache suite ticket.');
        $client = \Mockery::mock(SuiteTicket::class.'[getCache]', [new Application(['suite_id' => 'mock-suite-id'])], function ($mock) {
            $cache = \Mockery::mock(CacheInterface::class, function ($mock) {
                $key = 'easywechat.open_work.suite_ticket.mock-suite-id';
                $mock->expects()->set($key, 'mock-suit-ticket@666', 1800);
                $mock->expects()->has($key)->andReturn(false);
            });
            $mock->allows()->getCache()->andReturn($cache);
        });
        $client->setTicket('mock-suit-ticket@666');
    }

    public function testGetTicket()
    {
        $client = \Mockery::mock(SuiteTicket::class.'[getCache]', [new Application(['suite_id' => 'mock-suite-id'])], function ($mock) {
            $cache = \Mockery::mock(CacheInterface::class, function ($mock) {
                $mock->expects()->get('easywechat.open_work.suite_ticket.mock-suite-id')->andReturn('mock-suit-ticket@666');
            });
            $mock->allows()->getCache()->andReturn($cache);
        });

        $this->assertSame('mock-suit-ticket@666', $client->getTicket());
    }

    public function testGetTicketAndThrowException()
    {
        $client = \Mockery::mock(SuiteTicket::class.'[getCache]', [new Application(['suite_id' => 'mock-suite-id'])], function ($mock) {
            $cache = \Mockery::mock(CacheInterface::class, function ($mock) {
                $mock->expects()->get('easywechat.open_work.suite_ticket.mock-suite-id')->andReturn(null);
            });
            $mock->allows()->getCache()->andReturn($cache);
        });

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Credential "suite_ticket" does not exist in cache.');
        $client->getTicket();
    }
}

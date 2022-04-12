<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\Work\Server;

use Surpaimb\WeChat\Kernel\ServiceContainer;
use Surpaimb\WeChat\Tests\TestCase;
use Surpaimb\WeChat\Work\Server\Guard;
use Symfony\Component\HttpFoundation\Request;

class GuardTest extends TestCase
{
    public function testValidate()
    {
        $guard = \Mockery::mock(Guard::class)->makePartial();
        $this->assertSame($guard, $guard->validate());
    }

    public function testShouldReturnRawResponse()
    {
        $app = new ServiceContainer([], [
            'request' => Request::create('/path/to/resource?echostr=foo'),
        ]);
        $guard = \Mockery::mock(Guard::class, [$app])->makePartial();
        $this->assertTrue($guard->shouldReturnRawResponse());

        $app = new ServiceContainer([], [
            'request' => Request::create('/path/to/resource?foo=bar'),
        ]);
        $guard = \Mockery::mock(Guard::class, [$app])->makePartial();
        $this->assertFalse($guard->shouldReturnRawResponse());
    }

    public function testIsSafeMode()
    {
        $guard = \Mockery::mock(Guard::class, [new ServiceContainer()])->makePartial();
        $method = new \ReflectionMethod($guard, 'isSafeMode');
        $method->setAccessible(true);

        $this->assertTrue($method->invoke($guard));
    }
}

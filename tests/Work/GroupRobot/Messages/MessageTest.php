<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Work\GroupRobot\Messages;

use Surpaimb\WeChat\Kernel\Messages\Message as BaseMessage;
use Surpaimb\WeChat\Tests\TestCase;
use Surpaimb\WeChat\Work\GroupRobot\Messages\Message;

class MessageTest extends TestCase
{
    public function testBasicFeatures()
    {
        $message = new Message(['foo' => 'bar']);

        $this->assertSame('bar', $message->foo);
        $this->assertInstanceOf(BaseMessage::class, $message);
    }
}

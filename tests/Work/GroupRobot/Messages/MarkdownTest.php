<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\Work\GroupRobot\Messages;

use Surpaimb\WeChat\Tests\TestCase;
use Surpaimb\WeChat\Work\GroupRobot\Messages\Markdown;
use Surpaimb\WeChat\Work\GroupRobot\Messages\Message;

class MarkdownTest extends TestCase
{
    public function testBasicFeatures()
    {
        $markdown = new Markdown('mock-content');

        $this->assertSame('mock-content', $markdown->content);
        $this->assertInstanceOf(Message::class, $markdown);
    }
}

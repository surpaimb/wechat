<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\Kernel\Messages;

use Surpaimb\WeChat\Kernel\Messages\Video;
use Surpaimb\WeChat\Tests\TestCase;

class VideoTest extends TestCase
{
    public function testToXmlArray()
    {
        $message = new Video('mock-media-id', [
                'title' => '告白气球',
                'description' => '告白气球 - 周杰伦',
            ]);

        $this->assertSame([
            'Video' => [
                'MediaId' => 'mock-media-id',
                'Title' => '告白气球',
                'Description' => '告白气球 - 周杰伦',
            ],
        ], $message->toXmlArray());
    }
}

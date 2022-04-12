<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\BasicService;

use Surpaimb\WeChat\OfficialAccount\Application;
use Surpaimb\WeChat\Tests\TestCase;

class ApplicationTest extends TestCase
{
    public function testProperties()
    {
        $app = new Application();

        $this->assertInstanceOf(\Surpaimb\WeChat\BasicService\Media\Client::class, $app->media);
        $this->assertInstanceOf(\Surpaimb\WeChat\BasicService\Url\Client::class, $app->url);
        $this->assertInstanceOf(\Surpaimb\WeChat\BasicService\QrCode\Client::class, $app->qrcode);
        $this->assertInstanceOf(\Surpaimb\WeChat\BasicService\Jssdk\Client::class, $app->jssdk);
    }
}

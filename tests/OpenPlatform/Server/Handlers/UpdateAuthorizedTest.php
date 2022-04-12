<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OpenPlatform;

use Surpaimb\WeChat\OpenPlatform\Server\Handlers\UpdateAuthorized;
use Surpaimb\WeChat\Tests\TestCase;

class UpdateAuthorizedTest extends TestCase
{
    public function testHandle()
    {
        $handler = new UpdateAuthorized();

        $this->assertNull($handler->handle());
    }
}

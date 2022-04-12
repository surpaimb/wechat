<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OpenPlatform\Authorizer\MiniProgram;

use Surpaimb\WeChat\OpenPlatform\Authorizer\MiniProgram\Application;
use Surpaimb\WeChat\Tests\TestCase;

class ApplicationTest extends TestCase
{
    public function testProperties()
    {
        $app = new Application(['app_id' => 'app-id']);

        $this->assertInstanceOf(\Surpaimb\WeChat\OpenPlatform\Authorizer\MiniProgram\Account\Client::class, $app->account);
    }
}

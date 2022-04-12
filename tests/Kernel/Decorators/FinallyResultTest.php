<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\Kernel\Decorators;

use Surpaimb\WeChat\Kernel\Decorators\FinallyResult;
use Surpaimb\WeChat\Tests\TestCase;

class FinallyResultTest extends TestCase
{
    public function testGetContent()
    {
        $result = new FinallyResult('foo');

        $this->assertSame('foo', $result->content);
    }
}

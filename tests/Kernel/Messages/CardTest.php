<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Test\Kernel\Messages;

use Surpaimb\WeChat\Kernel\Messages\Card;
use Surpaimb\WeChat\Tests\TestCase;

class CardTest extends TestCase
{
    public function testBasicFeatures()
    {
        $card = new Card('mock-card-id');

        $this->assertSame('mock-card-id', $card->card_id);
    }
}

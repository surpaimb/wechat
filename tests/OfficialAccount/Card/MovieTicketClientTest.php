<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OfficialAccount\Card;

use Surpaimb\WeChat\OfficialAccount\Card\MovieTicketClient;
use Surpaimb\WeChat\Tests\TestCase;

class MovieTicketClientTest extends TestCase
{
    public function testUpdateUser()
    {
        $client = $this->mockApiClient(MovieTicketClient::class);

        $client->expects()->httpPostJson('card/movieticket/updateuser', ['foo' => 'bar'])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->updateUser(['foo' => 'bar']));
    }
}

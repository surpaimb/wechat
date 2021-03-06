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

use Surpaimb\WeChat\OfficialAccount\Card\MeetingTicketClient;
use Surpaimb\WeChat\Tests\TestCase;

class MeetingTicketClientTest extends TestCase
{
    public function testUpdateUser()
    {
        $client = $this->mockApiClient(MeetingTicketClient::class);

        $params = [
            'foo' => 'bar',
        ];
        $client->expects()->httpPostJson('card/meetingticket/updateuser', $params)->andReturn('mock-result');

        $this->assertSame('mock-result', $client->updateUser($params));
    }
}

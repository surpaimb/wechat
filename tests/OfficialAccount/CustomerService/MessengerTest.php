<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OfficialAccount\CustomerService;

use Surpaimb\WeChat\Kernel\Exceptions\RuntimeException;
use Surpaimb\WeChat\Kernel\Messages\Raw;
use Surpaimb\WeChat\Kernel\Messages\Text;
use Surpaimb\WeChat\OfficialAccount\CustomerService\Client;
use Surpaimb\WeChat\OfficialAccount\CustomerService\Messenger;
use Surpaimb\WeChat\Tests\TestCase;

class MessengerTest extends TestCase
{
    public function testSendWithoutMessage()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('No message to send.');

        $messenger = new Messenger(\Mockery::mock(Client::class));
        $messenger->send();
    }

    public function testSend()
    {
        $client = \Mockery::mock(Client::class);

        // without by
        $client->expects()->send([
            'touser' => 'mock-openid',
            'msgtype' => 'text',
            'text' => ['content' => 'text message.'],
        ]);
        $messenger = new Messenger($client);
        $messenger->message('text message.')->to('mock-openid');
        $messenger->send();

        // with from
        $client->expects()->send([
            'touser' => 'mock-openid',
            'msgtype' => 'text',
            'customservice' => [
                'kf_account' => 'overtrue@test',
            ],
            'text' => ['content' => 'text message.'],
        ]);
        $messenger = new Messenger($client);
        $messenger->message('text message.')->to('mock-openid')->from('overtrue@test');
        $messenger->send();

        // property access
        $this->assertInstanceOf(Text::class, $messenger->message);
        $this->assertSame('mock-openid', $messenger->to);
        $this->assertNull($messenger->not_exists_property);
    }

    public function testSendWithRawMessage()
    {
        $client = \Mockery::mock(Client::class);

        $message = new Raw(json_encode([
            'touser' => 'mock-openid',
            'msgtype' => 'text',
            'text' => ['content' => 'text message.'],
        ]));

        $client->expects()->send([
            'touser' => 'mock-openid',
            'msgtype' => 'text',
            'text' => ['content' => 'text message.'],
        ]);
        $messenger = new Messenger($client);
        $messenger->message($message)->to('mock-openid');
        $messenger->send();
    }
}

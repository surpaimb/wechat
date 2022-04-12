<?php

/*
 * This file is part of the overtrue/wechat.
 *
 */

namespace Surpaimb\WeChat\Tests\MiniProgram\Business;

use Surpaimb\WeChat\Kernel\Messages\Raw;
use Surpaimb\WeChat\Kernel\Messages\Text;
use Surpaimb\WeChat\MiniProgram\Business\Client;
use Surpaimb\WeChat\MiniProgram\Business\Messenger;
use Surpaimb\WeChat\Tests\TestCase;

class MessengerTest extends TestCase
{
    public function testSend()
    {
        $client = \Mockery::mock(Client::class);

        // without by
        $client->expects()->send([
            'touser' => 'mock-openid',
            'businessid' => 1,
            'msgtype' => 'text',
            'text' => ['content' => 'text message.'],
        ]);
        $messenger = new Messenger($client);
        $messenger->message('text message.')->business(1)->to('mock-openid');
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
        $messenger->message($message)->business(1)->to('mock-openid');
        $messenger->send();
    }
}

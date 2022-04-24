<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\Work;

use Surpaimb\WeChat\Tests\TestCase;
use Surpaimb\WeChat\Work\Application;
use Surpaimb\WeChat\Work\Base\Client;

class ApplicationTest extends TestCase
{
    public function testInstances()
    {
        $app = new Application([
            'corp_id' => 'xwnaka223',
            'agent_id' => 102093,
            'secret' => 'secret',
        ]);

        $this->assertInstanceOf(\Surpaimb\WeChat\Work\OA\Client::class, $app->oa);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Auth\AccessToken::class, $app->access_token);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Agent\Client::class, $app->agent);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Chat\Client::class, $app->chat);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Department\Client::class, $app->department);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Media\Client::class, $app->media);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Menu\Client::class, $app->menu);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Message\Client::class, $app->message);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Message\Messenger::class, $app->messenger);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Server\Guard::class, $app->server);
        $this->assertInstanceOf(\Surpaimb\WeChat\BasicService\Jssdk\Client::class, $app->jssdk);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\OAuth\Manager::class, $app->oauth);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\ExternalContact\Client::class, $app->external_contact);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\ExternalContact\ContactWayClient::class, $app->contact_way);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\ExternalContact\GroupChatWayClient::class, $app->group_chat_way);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\ExternalContact\StatisticsClient::class, $app->external_contact_statistics);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\ExternalContact\MessageClient::class, $app->external_contact_message);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Live\Client::class, $app->live);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\CorpGroup\Client::class, $app->corp_group);
    }

    public function testMiniProgram()
    {
        $app = new Application([
            'response_type' => 'array',
            'log' => [
                'level' => 'debug',
                'permission' => 0777,
                'file' => '/tmp/easywechat.log',
            ],
            'debug' => true,
            'corp_id' => 'corp-id',
            'agent_id' => 100020,
            'secret' => 'secret',
        ]);

        $miniProgram = $app->miniProgram();
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\MiniProgram\Application::class, $miniProgram);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Auth\AccessToken::class, $miniProgram['access_token']);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\MiniProgram\Auth\Client::class, $miniProgram['auth']);
        $this->assertArraySubset([
            'response_type' => 'array',
            'log' => [
                'level' => 'debug',
                'permission' => 0777,
                'file' => '/tmp/easywechat.log',
            ],
            'debug' => true,
            'corp_id' => 'corp-id',
            'agent_id' => 100020,
            'secret' => 'secret',
        ], $miniProgram->config->toArray());
    }

    public function testBaseCall()
    {
        $client = \Mockery::mock(Client::class);
        $client->expects()->getCallbackIp(1, 2, 3)->andReturn('mock-result');

        $app = new Application([]);
        $app['base'] = $client;

        $this->assertSame('mock-result', $app->getCallbackIp(1, 2, 3));
    }
}

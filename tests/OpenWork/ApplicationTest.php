<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OpenWork;

use Surpaimb\WeChat\OpenWork\Application;
use Surpaimb\WeChat\Tests\TestCase;

class ApplicationTest extends TestCase
{
    public function testProperties()
    {
        $app = new Application(['corp_id' => 'mock-corp-id']);

        $this->assertInstanceOf(\Surpaimb\WeChat\OpenWork\Server\Guard::class, $app->server);
        $this->assertInstanceOf(\Surpaimb\WeChat\OpenWork\Corp\Client::class, $app->corp);
        $this->assertInstanceOf(\Surpaimb\WeChat\OpenWork\Provider\Client::class, $app->provider);
        $this->assertInstanceOf(\Surpaimb\WeChat\OpenWork\MiniProgram\Client::class, $app->mini_program);
    }

    public function testWork()
    {
        $app = new Application(['corp_id' => 'mock-corp-id']);
        $work = $app->work('mock-auth-corp-id', 'mock-permanent-code');

        $this->assertInstanceOf('\Surpaimb\WeChat\OpenWork\Work\Application', $work);
        $this->assertInstanceOf('Surpaimb\WeChat\OpenWork\Work\Auth\AccessToken', $work->access_token);

        $this->assertInstanceOf('Surpaimb\WeChat\Work\Application', $work);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\OA\Client::class, $work->oa);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Agent\Client::class, $work->agent);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Chat\Client::class, $work->chat);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Department\Client::class, $work->department);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Media\Client::class, $work->media);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Menu\Client::class, $work->menu);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Message\Client::class, $work->message);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Message\Messenger::class, $work->messenger);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\Server\Guard::class, $work->server);
        $this->assertInstanceOf(\Surpaimb\WeChat\BasicService\Jssdk\Client::class, $work->jssdk);
        $this->assertInstanceOf(\Surpaimb\WeChat\Work\OAuth\Manager::class, $work->oauth);
    }

    public function testDynamicCalls()
    {
        $app = new Application(['corp_id' => 'mock-corp-id']);
        $app['base'] = new class() {
            public function dummyMethod()
            {
                return 'mock-result';
            }
        };

        $this->assertSame('mock-result', $app->dummyMethod());
    }
}

<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OfficialAccount;

use Surpaimb\WeChat\OfficialAccount\Application;
use Surpaimb\WeChat\Tests\TestCase;

class ApplicationTest extends TestCase
{
    public function testProperties()
    {
        $app = new Application();

        $this->assertInstanceOf(\Surpaimb\WeChat\BasicService\Media\Client::class, $app->media);
        $this->assertInstanceOf(\Surpaimb\WeChat\BasicService\Url\Client::class, $app->url);
        $this->assertInstanceOf(\Surpaimb\WeChat\BasicService\QrCode\Client::class, $app->qrcode);
        $this->assertInstanceOf(\Surpaimb\WeChat\BasicService\Jssdk\Client::class, $app->jssdk);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\Auth\AccessToken::class, $app->access_token);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\Server\Guard::class, $app->server);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\User\UserClient::class, $app->user);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\User\TagClient::class, $app->user_tag);
        $this->assertInstanceOf(\Overtrue\Socialite\Providers\WeChat::class, $app->oauth);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\Menu\Client::class, $app->menu);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\TemplateMessage\Client::class, $app->template_message);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\Material\Client::class, $app->material);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\CustomerService\Client::class, $app->customer_service);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\Semantic\Client::class, $app->semantic);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\DataCube\Client::class, $app->data_cube);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\AutoReply\Client::class, $app->auto_reply);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\Broadcasting\Client::class, $app->broadcasting);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\Card\Client::class, $app->card);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\Device\Client::class, $app->device);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\ShakeAround\Client::class, $app->shake_around);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\Base\Client::class, $app->base);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\Draft\Client::class, $app->draft);
        $this->assertInstanceOf(\Surpaimb\WeChat\OfficialAccount\FreePublish\Client::class, $app->free_publish);
    }
}

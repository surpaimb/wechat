<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OpenPlatform\CodeTemplate;

use Surpaimb\WeChat\OpenPlatform\CodeTemplate\Client;
use Surpaimb\WeChat\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testGetDrafts()
    {
        $client = $this->mockApiClient(Client::class, []);

        $client->expects()->httpGet('wxa/gettemplatedraftlist')->andReturn('mock-result');

        $this->assertSame('mock-result', $client->getDrafts());
    }

    public function testCreateFromDraft()
    {
        $client = $this->mockApiClient(Client::class, []);

        $client->expects()->httpPostJson('wxa/addtotemplate', ['draft_id' => 123, 'template_type' => 0])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->createFromDraft(123));
    }

    public function testList()
    {
        $client = $this->mockApiClient(Client::class, []);

        $client->expects()->httpGet('wxa/gettemplatelist', ['template_type' => null])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->list());
    }

    public function testDelete()
    {
        $client = $this->mockApiClient(Client::class, []);

        $client->expects()->httpPostJson('wxa/deletetemplate', ['template_id' => 234])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->delete(234));
    }
}

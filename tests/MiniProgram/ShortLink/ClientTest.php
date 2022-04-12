<?php

namespace Surpaimb\WeChat\Tests\MiniProgram\ShortLink;

use Surpaimb\WeChat\MiniProgram\ShortLink\Client;
use Surpaimb\WeChat\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testGenerate()
    {
        $client = $this->mockApiClient(Client::class)->makePartial();


        $client->expects()->httpPostJson('wxa/genwxashortlink', [
            'page_url' => 'pages/home/index',
            'page_title' => 'title',
            'is_permanent' => false
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->getShortLink('pages/home/index', 'title', false));
    }
}

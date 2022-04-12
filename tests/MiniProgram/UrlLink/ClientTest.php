<?php

namespace Surpaimb\WeChat\Tests\MiniProgram\UrlLink;

use Surpaimb\WeChat\MiniProgram\UrlLink\Client;
use Surpaimb\WeChat\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testGenerate()
    {
        $client = $this->mockApiClient(Client::class)->makePartial();

        $client->expects()->httpPostJson('wxa/generate_urllink', [
            'path' => 'pages/home/index',
            'query' => '1002',
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->generate([
            'path' => 'pages/home/index',
            'query' => '1002',
        ]));
    }
}

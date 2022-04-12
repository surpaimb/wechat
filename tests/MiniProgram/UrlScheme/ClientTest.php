<?php

namespace Surpaimb\WeChat\Tests\MiniProgram\UrlScheme;

use Surpaimb\WeChat\MiniProgram\UrlScheme\Client;
use Surpaimb\WeChat\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testGenerate()
    {
        $client = $this->mockApiClient(Client::class)->makePartial();

        $expireTime = time() + (7 * 24 * 60 * 60);

        $client->expects()->httpPostJson('wxa/generatescheme', [
            [
                'path' => 'pages/home/index',
                'query' => '1002',
            ],
            true,
            $expireTime
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->generate([
            [
                'path' => 'pages/home/index',
                'query' => '1002',
            ],
            true,
            $expireTime
        ]));
    }
}

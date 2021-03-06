<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\MicroMerchant\Kernel;

use Surpaimb\WeChat\Kernel\Http\Response;
use Surpaimb\WeChat\Kernel\Support;
use Surpaimb\WeChat\MicroMerchant\Application;
use Surpaimb\WeChat\MicroMerchant\Kernel\BaseClient;
use Surpaimb\WeChat\Tests\TestCase;

class BaseClientTest extends TestCase
{
    public function testRequest()
    {
        $app = new Application(['key' => '88888888888888888888888888888888']);

        $client = $this->mockApiClient(BaseClient::class, ['performRequest', 'castResponseToType'], $app)->makePartial();

        $api = 'http://easywechat.org';
        $params = ['foo' => 'bar', 'nonce_str' => '112'];
        $method = \Mockery::anyOf(['get', 'post']);
        $options = ['foo' => 'bar'];

        $mockResponse = new Response(200, [], 'response-content');

        $client->expects()->performRequest($api, $method, \Mockery::on(function ($options) {
            $this->assertSame('bar', $options['foo']);
            $this->assertIsString($options['body']);

            $bodyInOptions = Support\XML::parse($options['body']);

            $this->assertSame($bodyInOptions['foo'], $options['foo']);
            $this->assertIsString($bodyInOptions['nonce_str']);
            $this->assertIsString($bodyInOptions['sign']);

            return true;
        }))->times(3)->andReturn($mockResponse);

        $client->expects()->castResponseToType()
            ->with($mockResponse, \Mockery::any())->times(3)
            ->andReturn(['foo' => 'mock-bar', 'return_code' => '1212']);

        // $returnResponse = false
        $this->assertSame(['foo' => 'mock-bar', 'return_code' => '1212'], $client->request($api, $params, $method, $options, false));

        // $returnResponse = true
        $this->assertInstanceOf(Response::class, $client->request($api, $params, $method, $options, true));
        $this->assertSame('response-content', $client->request($api, $params, $method, $options, true)->getBodyContents());
    }

    public function testRequestRaw()
    {
        $app = new Application();

        $client = $this->mockApiClient(BaseClient::class, ['request', 'requestRaw'], $app)->makePartial();

        $api = 'http://easywechat.org';
        $params = ['foo' => 'bar'];
        $method = \Mockery::anyOf(['get', 'post']);
        $options = [];

        $client->expects()->request($api, $params, $method, $options, true)->andReturn('mock-result');

        $this->assertSame('mock-result', $client->requestRaw($api, $params, $method, $options));
    }

    public function testSafeRequest()
    {
        $app = new Application([
            'app_id' => 'wx123456',
            'cert_path' => 'foo',
            'key_path' => 'bar',
        ]);

        $client = $this->mockApiClient(BaseClient::class, ['safeRequest'], $app)->makePartial();

        $api = 'http://easywechat.org';
        $params = ['foo' => 'bar'];
        $method = \Mockery::anyOf(['get', 'post']);

        $client->expects()->request($api, $params, $method, \Mockery::on(function ($options) use ($app) {
            $this->assertSame($options['cert'], $app['config']->get('cert_path'));
            $this->assertSame($options['ssl_key'], $app['config']->get('key_path'));

            return true;
        }))->andReturn('mock-result');

        $this->assertSame('mock-result', $client->safeRequest($api, $params, $method));
    }

    /**
     * @dataProvider bodySignProvider
     */
    public function testBodySign($signType, $nonceStr, $sign)
    {
        $app = new Application([
            'key' => '88888888888888888888888888888888',
        ]);

        $client = $this->mockApiClient(BaseClient::class, ['performRequest'], $app)->makePartial();

        $api = 'http://easywechat.org';
        $params = [
            'foo' => 'bar',
            'nonce_str' => $nonceStr,
            'sign_type' => $signType,
        ];
        $method = \Mockery::anyOf(['get', 'post']);
        $options = [];

        $mockResponse = new Response(200, [], 'response-content');

        $client->expects()->performRequest($api, $method, \Mockery::on(function ($options) use ($sign) {
            $bodyInOptions = Support\XML::parse($options['body']);

            $this->assertSame($sign, $bodyInOptions['sign']);

            return true;
        }))->andReturn($mockResponse);

        $this->assertSame('response-content', $client->requestRaw($api, $params, $method, $options)->getBodyContents());
    }

    public function bodySignProvider()
    {
        return [
            ['', '5c3bfd3227348', '82125D68D3C25B2B78D53F66E12EC89A'],
            ['MD5', '5c3bfe0343bab', 'A9237F1A2DF77FF900CFFB7B432CD1A9'],
            ['HMAC-SHA256', '5c3bfe6716023', 'A890BD78E9B1563C546D07F21E8C8D96B146CFE5B18941C312678B5636263DE6'],
        ];
    }

    public function testGetSign()
    {
        $app = new Application(['mch_id' => 'mock-mch_id', 'key' => '88888888888888888888888888888888']);
        $client = $this->mockApiClient(BaseClient::class, [], $app)->makePartial();
        $client->getSign(['foo' => 'bar']);

        $this->assertSame('834A25C9A5B48305AB997C9A7E101530', $client->getSign(['foo' => 'bar']));
    }

    public function testhttpUpload()
    {
        $app = new Application();

        $client = $this->mockApiClient(BaseClient::class, ['httpUpload'], $app)->makePartial();
        $url = 'http://easywechat.org';
        $files = ['foo' => 'bar'];
        $form = ['foo' => 'bar'];

        $client->expects()->httpUpload($url, $files, $form)->andReturn('mock-result');

        $this->assertSame('mock-result', $client->httpUpload($url, $files, $form));
    }
}

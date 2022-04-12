<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\Payment\Security;

use Surpaimb\WeChat\Payment\Application;
use Surpaimb\WeChat\Payment\Security\Client;
use Surpaimb\WeChat\Tests\TestCase;

class ClientTest extends TestCase
{
    /**
     * Make Application.
     *
     * @param array $config
     *
     * @return \Surpaimb\WeChat\Payment\Application
     */
    private function makeApp($config = [])
    {
        return new Application(array_merge([
            'app_id' => 'wx123456',
            'mch_id' => 'foo-mcherant-id',
            'key' => 'foo-mcherant-key',
            'sub_appid' => 'foo-sub-appid',
            'sub_mch_id' => 'foo-sub-mch-id',
            'rsa_public_key_path' => \STUBS_ROOT.'/files/public-wx123456.pem',
        ], $config));
    }

    public function testGetPublicKey()
    {
        $app = $this->makeApp();

        $client = $this->mockApiClient(Client::class, ['safeRequest'], $app)->makePartial();

        $client->expects()->safeRequest('https://fraud.mch.weixin.qq.com/risk/getpublickey', [
            'sign_type' => 'MD5',
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->getPublicKey());
    }
}

<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\OfficialAccount\OCR;

use Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException;
use Surpaimb\WeChat\OfficialAccount\OCR\Client;
use Surpaimb\WeChat\Tests\TestCase;

class ClientTest extends TestCase
{
    public function testIdCard()
    {
        $client = $this->mockApiClient(Client::class);

        $path = '/foo/bar.jpg';
        $client->expects()->httpPost('cv/ocr/idcard', [
            'type' => 'photo',
            'img_url' => $path,
        ])->andReturn('mock-result');
        $this->assertSame('mock-result', $client->idCard($path, 'photo'));

        $client->expects()->httpPost('cv/ocr/idcard', [
            'type' => 'scan',
            'img_url' => $path,
        ])->andReturn('mock-result');
        $this->assertSame('mock-result', $client->idCard($path, 'scan'));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported type: \'image\'');
        $client->idCard($path, 'image');
    }

    public function testBankCard()
    {
        $client = $this->mockApiClient(Client::class);

        $path = '/foo/bar.jpg';
        $client->expects()->httpPost('cv/ocr/bankcard', [
            'img_url' => $path,
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->bankCard($path));
    }

    public function testVehicleLicense()
    {
        $client = $this->mockApiClient(Client::class);

        $path = '/foo/bar.jpg';
        $client->expects()->httpPost('cv/ocr/drivinglicense', [
            'img_url' => $path,
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->vehicleLicense($path));
    }

    public function testDriving()
    {
        $client = $this->mockApiClient(Client::class);

        $path = '/foo/bar.jpg';
        $client->expects()->httpPost('cv/ocr/driving', [
            'img_url' => $path,
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->driving($path));
    }

    public function testBizLicense()
    {
        $client = $this->mockApiClient(Client::class);

        $path = '/foo/bar.jpg';
        $client->expects()->httpPost('cv/ocr/bizlicense', [
            'img_url' => $path,
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->bizLicense($path));
    }

    public function testCommon()
    {
        $client = $this->mockApiClient(Client::class);

        $path = '/foo/bar.jpg';
        $client->expects()->httpPost('cv/ocr/comm', [
            'img_url' => $path,
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->common($path));
    }

    public function testPlateNumber()
    {
        $client = $this->mockApiClient(Client::class);

        $path = '/foo/bar.jpg';
        $client->expects()->httpPost('cv/ocr/platenum', [
            'img_url' => $path,
        ])->andReturn('mock-result');

        $this->assertSame('mock-result', $client->plateNumber($path));
    }
}

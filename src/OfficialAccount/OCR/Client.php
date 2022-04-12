<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\OfficialAccount\OCR;

use Surpaimb\WeChat\Kernel\BaseClient;
use Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Client.
 *
 * @author joyeekk <xygao2420@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * Allow image parameter type.
     *
     * @var array
     */
    protected $allowTypes = ['photo', 'scan'];

    /**
     * ID card OCR.
     *
     * @param string $path
     * @param string $type
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function idCard(string $path, string $type = 'photo')
    {
        if (!\in_array($type, $this->allowTypes, true)) {
            throw new InvalidArgumentException(sprintf("Unsupported type: '%s'", $type));
        }

        return $this->httpPost('cv/ocr/idcard', [
            'type' => $type,
            'img_url' => $path,
        ]);
    }

    /**
     * Bank card OCR.
     *
     * @param string $path
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function bankCard(string $path)
    {
        return $this->httpPost('cv/ocr/bankcard', [
            'img_url' => $path,
        ]);
    }

    /**
     * Vehicle license OCR.
     *
     * @param string $path
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function vehicleLicense(string $path)
    {
        return $this->httpPost('cv/ocr/drivinglicense', [
            'img_url' => $path,
        ]);
    }

    /**
     * Driving OCR.
     *
     * @param string $path
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function driving(string $path)
    {
        return $this->httpPost('cv/ocr/driving', [
            'img_url' => $path,
        ]);
    }

    /**
     * Biz License OCR.
     *
     * @param string $path
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function bizLicense(string $path)
    {
        return $this->httpPost('cv/ocr/bizlicense', [
            'img_url' => $path,
        ]);
    }

    /**
     * Common OCR.
     *
     * @param string $path
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function common(string $path)
    {
        return $this->httpPost('cv/ocr/comm', [
            'img_url' => $path,
        ]);
    }

    /**
     * Plate Number OCR.
     *
     * @param string $path
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function plateNumber(string $path)
    {
        return $this->httpPost('cv/ocr/platenum', [
            'img_url' => $path,
        ]);
    }
}

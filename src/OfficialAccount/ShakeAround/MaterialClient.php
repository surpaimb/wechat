<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\OfficialAccount\ShakeAround;

use Surpaimb\WeChat\Kernel\BaseClient;
use Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class MaterialClient.
 *
 * @author allen05ren <allen05ren@outlook.com>
 */
class MaterialClient extends BaseClient
{
    /**
     * Upload image material.
     *
     * @param string $path
     * @param string $type
     *
     * @return string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadImage(string $path, string $type = 'icon')
    {
        if (!file_exists($path) || !is_readable($path)) {
            throw new InvalidArgumentException(sprintf('File does not exist, or the file is unreadable: "%s"', $path));
        }

        return $this->httpUpload('shakearound/material/add', ['media' => $path], [], ['type' => strtolower($type)]);
    }
}

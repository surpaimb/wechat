<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\MiniProgram\Material;

use Surpaimb\WeChat\Kernel\BaseClient;
use Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException;
use Surpaimb\WeChat\Kernel\Http\StreamResponse;
use Surpaimb\WeChat\Kernel\Messages\Article;

/**
 * Class Client.
 *
 * @author overtrue <i@overtrue.me>
 */
class Client extends BaseClient
{
    /**
     * Allow media type.
     *
     * @var array
     */
    protected $allowTypes = ['image', 'voice', 'video', 'thumb'];

    /**
     * Upload image.
     *
     * @param string $path
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadImage(string $path)
    {
        return $this->upload('image', $path);
    }

    /**
     * Upload voice.
     *
     * @param string $path
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadVoice(string $path)
    {
        return $this->upload('voice', $path);
    }

    /**
     * Upload thumb.
     *
     * @param string $path
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadThumb(string $path)
    {
        return $this->upload('thumb', $path);
    }

    /**
     * Upload video.
     *
     * @param string $path
     * @param string $title
     * @param string $description
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadVideo(string $path, string $title, string $description)
    {
        $params = [
            'description' => json_encode(
                [
                    'title' => $title,
                    'introduction' => $description,
                ],
                JSON_UNESCAPED_UNICODE
            ),
        ];

        return $this->upload('video', $path, $params);
    }

    /**
     * Upload material.
     *
     * @param string $type
     * @param string $path
     * @param array  $form
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function upload(string $type, string $path, array $form = [])
    {
        if (!file_exists($path) || !is_readable($path)) {
            throw new InvalidArgumentException(sprintf('File does not exist, or the file is unreadable: "%s"', $path));
        }

        $form['type'] = $type;

        return $this->httpUpload($this->getApiByType($type), ['media' => $path], $form);
    }

    /**
     * Get API by type.
     *
     * @param string $type
     *
     * @return string
     */
    public function getApiByType(string $type)
    {
        switch ($type) {
            default:
                return 'cgi-bin/media/upload';
        }
    }
}

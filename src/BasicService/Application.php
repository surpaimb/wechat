<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\BasicService;

use Surpaimb\WeChat\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author overtrue <i@overtrue.me>
 *
 * @property \Surpaimb\WeChat\BasicService\Jssdk\Client           $jssdk
 * @property \Surpaimb\WeChat\BasicService\Media\Client           $media
 * @property \Surpaimb\WeChat\BasicService\QrCode\Client          $qrcode
 * @property \Surpaimb\WeChat\BasicService\Url\Client             $url
 * @property \Surpaimb\WeChat\BasicService\ContentSecurity\Client $content_security
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Jssdk\ServiceProvider::class,
        QrCode\ServiceProvider::class,
        Media\ServiceProvider::class,
        Url\ServiceProvider::class,
        ContentSecurity\ServiceProvider::class,
    ];
}

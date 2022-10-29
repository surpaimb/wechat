<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Channel;

use Surpaimb\WeChat\BasicService;
use Surpaimb\WeChat\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \Surpaimb\WeChat\Channel\Auth\AccessToken           $access_token
 * @property \Surpaimb\WeChat\Channel\Auth\Client                $auth
 * @property \Surpaimb\WeChat\BasicService\Media\Client              $media
 * @property \Surpaimb\WeChat\BasicService\ContentSecurity\Client    $content_security
 * @property \Surpaimb\WeChat\Channel\Encryptor                  $encryptor
 * @property \Surpaimb\WeChat\Channel\Window\Client            $window
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        Server\ServiceProvider::class,
        Base\ServiceProvider::class,
        // Base services
        BasicService\Media\ServiceProvider::class,
        BasicService\ContentSecurity\ServiceProvider::class,

        Window\ServiceProvider::class,
    ];

    /**
     * Handle dynamic calls.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return $this->base->$method(...$args);
    }
}

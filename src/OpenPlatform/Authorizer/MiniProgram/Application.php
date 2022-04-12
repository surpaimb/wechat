<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\OpenPlatform\Authorizer\MiniProgram;

use Surpaimb\WeChat\MiniProgram\Application as MiniProgram;
use Surpaimb\WeChat\OpenPlatform\Authorizer\Aggregate\AggregateServiceProvider;

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \Surpaimb\WeChat\OpenPlatform\Authorizer\MiniProgram\Account\Client  $account
 * @property \Surpaimb\WeChat\OpenPlatform\Authorizer\MiniProgram\Code\Client     $code
 * @property \Surpaimb\WeChat\OpenPlatform\Authorizer\MiniProgram\Domain\Client   $domain
 * @property \Surpaimb\WeChat\OpenPlatform\Authorizer\MiniProgram\Setting\Client  $setting
 * @property \Surpaimb\WeChat\OpenPlatform\Authorizer\MiniProgram\Tester\Client   $tester
 * @property \Surpaimb\WeChat\OpenPlatform\Authorizer\MiniProgram\Material\Client $material
 */
class Application extends MiniProgram
{
    /**
     * Application constructor.
     *
     * @param array $config
     * @param array $prepends
     */
    public function __construct(array $config = [], array $prepends = [])
    {
        parent::__construct($config, $prepends);

        $providers = [
            AggregateServiceProvider::class,
            Code\ServiceProvider::class,
            Domain\ServiceProvider::class,
            Account\ServiceProvider::class,
            Setting\ServiceProvider::class,
            Tester\ServiceProvider::class,
            Material\ServiceProvider::class,
            Privacy\ServiceProvider::class,
        ];

        foreach ($providers as $provider) {
            $this->register(new $provider());
        }
    }
}

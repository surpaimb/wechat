<?php

/*
 * This file is part of the overtrue/wechat.
 *
 */

namespace Surpaimb\WeChat\Channel\Window;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 *
 * @author surpaimb <surpaimb@126.com>
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['window'] = function ($app) {
            return new Client($app);
        };
    }
}

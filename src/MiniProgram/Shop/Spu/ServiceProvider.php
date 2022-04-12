<?php

namespace Surpaimb\WeChat\MiniProgram\Shop\Spu;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * 自定义版交易组件及开放接口 - SPU接口
 *
 * @author HaoLiang <haoliang@qiyuankeji.cn>
 * @package Surpaimb\WeChat\MiniProgram\Shop\Spu
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['shop_spu'] = function ($app) {
            return new Client($app);
        };
    }
}

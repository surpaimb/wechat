<?php

namespace Surpaimb\WeChat\MiniProgram\Shop\Aftersale;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * 自定义版交易组件及开放接口 - 售后接口
 *
 * @package Surpaimb\WeChat\MiniProgram\Shop\Aftersale
 * @author HaoLiang <haoliang@qiyuankeji.cn>
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @inheritDoc
     */
    public function register(Container $app)
    {
        $app['shop_aftersale'] = function ($app) {
            return new Client($app);
        };
    }
}

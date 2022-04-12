<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\MiniProgram\Mall;

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \Surpaimb\WeChat\MiniProgram\Mall\OrderClient   $order
 * @property \Surpaimb\WeChat\MiniProgram\Mall\CartClient    $cart
 * @property \Surpaimb\WeChat\MiniProgram\Mall\ProductClient $product
 * @property \Surpaimb\WeChat\MiniProgram\Mall\MediaClient   $media
 */
class ForwardsMall
{
    /**
     * @var \Surpaimb\WeChat\Kernel\ServiceContainer
     */
    protected $app;

    /**
     * @param \Surpaimb\WeChat\Kernel\ServiceContainer $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        return $this->app["mall.{$property}"];
    }
}

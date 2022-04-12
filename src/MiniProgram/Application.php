<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\MiniProgram;

use Surpaimb\WeChat\BasicService;
use Surpaimb\WeChat\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \Surpaimb\WeChat\MiniProgram\Auth\AccessToken           $access_token
 * @property \Surpaimb\WeChat\MiniProgram\DataCube\Client            $data_cube
 * @property \Surpaimb\WeChat\MiniProgram\AppCode\Client             $app_code
 * @property \Surpaimb\WeChat\MiniProgram\Auth\Client                $auth
 * @property \Surpaimb\WeChat\OfficialAccount\Server\Guard           $server
 * @property \Surpaimb\WeChat\MiniProgram\Encryptor                  $encryptor
 * @property \Surpaimb\WeChat\MiniProgram\TemplateMessage\Client     $template_message
 * @property \Surpaimb\WeChat\OfficialAccount\CustomerService\Client $customer_service
 * @property \Surpaimb\WeChat\MiniProgram\Plugin\Client              $plugin
 * @property \Surpaimb\WeChat\MiniProgram\Plugin\DevClient           $plugin_dev
 * @property \Surpaimb\WeChat\MiniProgram\UniformMessage\Client      $uniform_message
 * @property \Surpaimb\WeChat\MiniProgram\ActivityMessage\Client     $activity_message
 * @property \Surpaimb\WeChat\MiniProgram\Express\Client             $logistics
 * @property \Surpaimb\WeChat\MiniProgram\NearbyPoi\Client           $nearby_poi
 * @property \Surpaimb\WeChat\MiniProgram\OCR\Client                 $ocr
 * @property \Surpaimb\WeChat\MiniProgram\Soter\Client               $soter
 * @property \Surpaimb\WeChat\BasicService\Media\Client              $media
 * @property \Surpaimb\WeChat\BasicService\ContentSecurity\Client    $content_security
 * @property \Surpaimb\WeChat\MiniProgram\Mall\ForwardsMall          $mall
 * @property \Surpaimb\WeChat\MiniProgram\SubscribeMessage\Client    $subscribe_message
 * @property \Surpaimb\WeChat\MiniProgram\RealtimeLog\Client         $realtime_log
 * @property \Surpaimb\WeChat\MiniProgram\RiskControl\Client         $risk_control
 * @property \Surpaimb\WeChat\MiniProgram\Search\Client              $search
 * @property \Surpaimb\WeChat\MiniProgram\Live\Client                $live
 * @property \Surpaimb\WeChat\MiniProgram\Broadcast\Client           $broadcast
 * @property \Surpaimb\WeChat\MiniProgram\UrlScheme\Client           $url_scheme
 * @property \Surpaimb\WeChat\MiniProgram\Union\Client               $union
 * @property \Surpaimb\WeChat\MiniProgram\Shop\Register\Client       $shop_register
 * @property \Surpaimb\WeChat\MiniProgram\Shop\Basic\Client          $shop_basic
 * @property \Surpaimb\WeChat\MiniProgram\Shop\Account\Client        $shop_account
 * @property \Surpaimb\WeChat\MiniProgram\Shop\Spu\Client            $shop_spu
 * @property \Surpaimb\WeChat\MiniProgram\Shop\Order\Client          $shop_order
 * @property \Surpaimb\WeChat\MiniProgram\Shop\Delivery\Client       $shop_delivery
 * @property \Surpaimb\WeChat\MiniProgram\Shop\Aftersale\Client      $shop_aftersale
 * @property \Surpaimb\WeChat\MiniProgram\Business\Client            $business
 * @property \Surpaimb\WeChat\MiniProgram\UrlLink\Client             $url_link
 * @property \Surpaimb\WeChat\MiniProgram\QrCode\Client              $qr_code
 * @property \Surpaimb\WeChat\MiniProgram\PhoneNumber\Client         $phone_number
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        DataCube\ServiceProvider::class,
        AppCode\ServiceProvider::class,
        Server\ServiceProvider::class,
        TemplateMessage\ServiceProvider::class,
        CustomerService\ServiceProvider::class,
        UniformMessage\ServiceProvider::class,
        ActivityMessage\ServiceProvider::class,
        OpenData\ServiceProvider::class,
        Plugin\ServiceProvider::class,
        QrCode\ServiceProvider::class,
        Base\ServiceProvider::class,
        Express\ServiceProvider::class,
        NearbyPoi\ServiceProvider::class,
        OCR\ServiceProvider::class,
        Soter\ServiceProvider::class,
        Mall\ServiceProvider::class,
        SubscribeMessage\ServiceProvider::class,
        RealtimeLog\ServiceProvider::class,
        RiskControl\ServiceProvider::class,
        Search\ServiceProvider::class,
        Live\ServiceProvider::class,
        Broadcast\ServiceProvider::class,
        UrlScheme\ServiceProvider::class,
        UrlLink\ServiceProvider::class,
        Union\ServiceProvider::class,
        PhoneNumber\ServiceProvider::class,
        // Base services
        BasicService\Media\ServiceProvider::class,
        BasicService\ContentSecurity\ServiceProvider::class,

        Shop\Register\ServiceProvider::class,
        Shop\Basic\ServiceProvider::class,
        Shop\Account\ServiceProvider::class,
        Shop\Spu\ServiceProvider::class,
        Shop\Order\ServiceProvider::class,
        Shop\Delivery\ServiceProvider::class,
        Shop\Aftersale\ServiceProvider::class,
        Business\ServiceProvider::class,
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

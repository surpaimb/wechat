<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\OfficialAccount;

use Surpaimb\WeChat\BasicService;
use Surpaimb\WeChat\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author overtrue <i@overtrue.me>
 *
 * @property \Surpaimb\WeChat\BasicService\Media\Client                     $media
 * @property \Surpaimb\WeChat\BasicService\Url\Client                       $url
 * @property \Surpaimb\WeChat\BasicService\QrCode\Client                    $qrcode
 * @property \Surpaimb\WeChat\BasicService\Jssdk\Client                     $jssdk
 * @property \Surpaimb\WeChat\OfficialAccount\Auth\AccessToken              $access_token
 * @property \Surpaimb\WeChat\OfficialAccount\Server\Guard                  $server
 * @property \Surpaimb\WeChat\OfficialAccount\User\UserClient               $user
 * @property \Surpaimb\WeChat\OfficialAccount\User\TagClient                $user_tag
 * @property \Surpaimb\WeChat\OfficialAccount\Menu\Client                   $menu
 * @property \Surpaimb\WeChat\OfficialAccount\TemplateMessage\Client        $template_message
 * @property \Surpaimb\WeChat\OfficialAccount\SubscribeMessage\Client       $subscribe_message
 * @property \Surpaimb\WeChat\OfficialAccount\Material\Client               $material
 * @property \Surpaimb\WeChat\OfficialAccount\CustomerService\Client        $customer_service
 * @property \Surpaimb\WeChat\OfficialAccount\CustomerService\SessionClient $customer_service_session
 * @property \Surpaimb\WeChat\OfficialAccount\Semantic\Client               $semantic
 * @property \Surpaimb\WeChat\OfficialAccount\DataCube\Client               $data_cube
 * @property \Surpaimb\WeChat\OfficialAccount\AutoReply\Client              $auto_reply
 * @property \Surpaimb\WeChat\OfficialAccount\Broadcasting\Client           $broadcasting
 * @property \Surpaimb\WeChat\OfficialAccount\Card\Card                     $card
 * @property \Surpaimb\WeChat\OfficialAccount\Device\Client                 $device
 * @property \Surpaimb\WeChat\OfficialAccount\ShakeAround\ShakeAround       $shake_around
 * @property \Surpaimb\WeChat\OfficialAccount\POI\Client                    $poi
 * @property \Surpaimb\WeChat\OfficialAccount\Store\Client                  $store
 * @property \Surpaimb\WeChat\OfficialAccount\Base\Client                   $base
 * @property \Surpaimb\WeChat\OfficialAccount\Comment\Client                $comment
 * @property \Surpaimb\WeChat\OfficialAccount\OCR\Client                    $ocr
 * @property \Surpaimb\WeChat\OfficialAccount\Goods\Client                  $goods
 * @property \Overtrue\Socialite\Providers\WeChat                      $oauth
 * @property \Surpaimb\WeChat\OfficialAccount\WiFi\Client                   $wifi
 * @property \Surpaimb\WeChat\OfficialAccount\WiFi\CardClient               $wifi_card
 * @property \Surpaimb\WeChat\OfficialAccount\WiFi\DeviceClient             $wifi_device
 * @property \Surpaimb\WeChat\OfficialAccount\WiFi\ShopClient               $wifi_shop
 * @property \Surpaimb\WeChat\OfficialAccount\Guide\Client                  $guide
 * @property \Surpaimb\WeChat\OfficialAccount\Draft\Client                  $draft
 * @property \Surpaimb\WeChat\OfficialAccount\FreePublish\Client            $free_publish
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        Server\ServiceProvider::class,
        User\ServiceProvider::class,
        OAuth\ServiceProvider::class,
        Menu\ServiceProvider::class,
        TemplateMessage\ServiceProvider::class,
        SubscribeMessage\ServiceProvider::class,
        Material\ServiceProvider::class,
        CustomerService\ServiceProvider::class,
        Semantic\ServiceProvider::class,
        DataCube\ServiceProvider::class,
        POI\ServiceProvider::class,
        AutoReply\ServiceProvider::class,
        Broadcasting\ServiceProvider::class,
        Card\ServiceProvider::class,
        Device\ServiceProvider::class,
        ShakeAround\ServiceProvider::class,
        Store\ServiceProvider::class,
        Comment\ServiceProvider::class,
        Base\ServiceProvider::class,
        OCR\ServiceProvider::class,
        Goods\ServiceProvider::class,
        WiFi\ServiceProvider::class,
        Draft\ServiceProvider::class,
        FreePublish\ServiceProvider::class,
        // Base services
        BasicService\QrCode\ServiceProvider::class,
        BasicService\Media\ServiceProvider::class,
        BasicService\Url\ServiceProvider::class,
        BasicService\Jssdk\ServiceProvider::class,
        // Append Guide Interface
        Guide\ServiceProvider::class,
    ];
}

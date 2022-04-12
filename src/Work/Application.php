<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Work;

use Surpaimb\WeChat\Kernel\ServiceContainer;
use Surpaimb\WeChat\Work\MiniProgram\Application as MiniProgram;

/**
 * Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \Surpaimb\WeChat\Work\OA\Client                             $oa
 * @property \Surpaimb\WeChat\Work\Auth\AccessToken                      $access_token
 * @property \Surpaimb\WeChat\Work\Agent\Client                          $agent
 * @property \Surpaimb\WeChat\Work\Department\Client                     $department
 * @property \Surpaimb\WeChat\Work\Media\Client                          $media
 * @property \Surpaimb\WeChat\Work\Menu\Client                           $menu
 * @property \Surpaimb\WeChat\Work\Message\Client                        $message
 * @property \Surpaimb\WeChat\Work\Message\Messenger                     $messenger
 * @property \Surpaimb\WeChat\Work\User\Client                           $user
 * @property \Surpaimb\WeChat\Work\User\TagClient                        $tag
 * @property \Surpaimb\WeChat\Work\Server\Guard                          $server
 * @property \Surpaimb\WeChat\Work\Jssdk\Client                          $jssdk
 * @property \Overtrue\Socialite\Providers\WeWork                   $oauth
 * @property \Surpaimb\WeChat\Work\Invoice\Client                        $invoice
 * @property \Surpaimb\WeChat\Work\Chat\Client                           $chat
 * @property \Surpaimb\WeChat\Work\ExternalContact\Client                $external_contact
 * @property \Surpaimb\WeChat\Work\ExternalContact\ContactWayClient      $contact_way
 * @property \Surpaimb\WeChat\Work\ExternalContact\StatisticsClient      $external_contact_statistics
 * @property \Surpaimb\WeChat\Work\ExternalContact\MessageClient         $external_contact_message
 * @property \Surpaimb\WeChat\Work\GroupRobot\Client                     $group_robot
 * @property \Surpaimb\WeChat\Work\GroupRobot\Messenger                  $group_robot_messenger
 * @property \Surpaimb\WeChat\Work\Calendar\Client                       $calendar
 * @property \Surpaimb\WeChat\Work\Schedule\Client                       $schedule
 * @property \Surpaimb\WeChat\Work\MsgAudit\Client                       $msg_audit
 * @property \Surpaimb\WeChat\Work\Live\Client                           $live
 * @property \Surpaimb\WeChat\Work\CorpGroup\Client                      $corp_group
 * @property \Surpaimb\WeChat\Work\ExternalContact\SchoolClient          $school
 * @property \Surpaimb\WeChat\Work\ExternalContact\MessageTemplateClient $external_contact_message_template
 * @property \Surpaimb\WeChat\Work\Kf\AccountClient                      $kf_account
 * @property \Surpaimb\WeChat\Work\Kf\ServicerClient                     $kf_servicer
 * @property \Surpaimb\WeChat\Work\Kf\MessageClient                      $kf_message
 * @property \Surpaimb\WeChat\Work\GroupWelcomeTemplate\Client           $group_welcome_templage
 *
 * @method mixed getCallbackIp()
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        OA\ServiceProvider::class,
        Auth\ServiceProvider::class,
        Base\ServiceProvider::class,
        Menu\ServiceProvider::class,
        OAuth\ServiceProvider::class,
        User\ServiceProvider::class,
        Agent\ServiceProvider::class,
        Media\ServiceProvider::class,
        Message\ServiceProvider::class,
        Department\ServiceProvider::class,
        Server\ServiceProvider::class,
        Jssdk\ServiceProvider::class,
        Invoice\ServiceProvider::class,
        Chat\ServiceProvider::class,
        ExternalContact\ServiceProvider::class,
        GroupRobot\ServiceProvider::class,
        Calendar\ServiceProvider::class,
        Schedule\ServiceProvider::class,
        MsgAudit\ServiceProvider::class,
        Live\ServiceProvider::class,
        CorpGroup\ServiceProvider::class,
        Mobile\ServiceProvider::class,
        Kf\ServiceProvider::class,
        GroupWelcomeTemplate\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [
        // http://docs.guzzlephp.org/en/stable/request-options.html
        'http' => [
            'base_uri' => 'https://qyapi.weixin.qq.com/',
        ],
    ];

    /**
     * Creates the miniProgram application.
     *
     * @return \Surpaimb\WeChat\Work\MiniProgram\Application
     */
    public function miniProgram(): MiniProgram
    {
        return new MiniProgram($this->getConfig());
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this['base']->$method(...$arguments);
    }
}

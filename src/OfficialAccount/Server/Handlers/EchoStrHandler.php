<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\OfficialAccount\Server\Handlers;

use Surpaimb\WeChat\Kernel\Contracts\EventHandlerInterface;
use Surpaimb\WeChat\Kernel\Decorators\FinallyResult;
use Surpaimb\WeChat\Kernel\ServiceContainer;

/**
 * Class EchoStrHandler.
 *
 * @author overtrue <i@overtrue.me>
 */
class EchoStrHandler implements EventHandlerInterface
{
    /**
     * @var ServiceContainer
     */
    protected $app;

    /**
     * EchoStrHandler constructor.
     *
     * @param ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * @param mixed $payload
     *
     * @return FinallyResult|null
     */
    public function handle($payload = null)
    {
        if ($str = $this->app['request']->get('echostr')) {
            return new FinallyResult($str);
        }

        return null;
    }
}

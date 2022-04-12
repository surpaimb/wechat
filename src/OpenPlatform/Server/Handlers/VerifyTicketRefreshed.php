<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\OpenPlatform\Server\Handlers;

use Surpaimb\WeChat\Kernel\Contracts\EventHandlerInterface;
use Surpaimb\WeChat\Kernel\Traits\ResponseCastable;
use Surpaimb\WeChat\OpenPlatform\Application;

use function Surpaimb\WeChat\Kernel\data_get;

/**
 * Class VerifyTicketRefreshed.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class VerifyTicketRefreshed implements EventHandlerInterface
{
    use ResponseCastable;

    /**
     * @var \Surpaimb\WeChat\OpenPlatform\Application
     */
    protected $app;

    /**
     * Constructor.
     *
     * @param \Surpaimb\WeChat\OpenPlatform\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}.
     */
    public function handle($payload = null)
    {
        $ticket = data_get($payload, 'ComponentVerifyTicket');

        if (!empty($ticket)) {
            $this->app['verify_ticket']->setTicket($ticket);
        }
    }
}

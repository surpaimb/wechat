<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Work\Message;

use Surpaimb\WeChat\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @param string|\Surpaimb\WeChat\Kernel\Messages\Message $message
     *
     * @return \Surpaimb\WeChat\Work\Message\Messenger
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public function message($message)
    {
        return (new Messenger($this))->message($message);
    }

    /**
     * @param array $message
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(array $message)
    {
        return $this->httpPostJson('cgi-bin/message/send', $message);
    }

    /**
     * 更新任务卡片消息状态
     *
     * @see https://open.work.weixin.qq.com/api/doc/90000/90135/91579
     *
     * @param array $userids
     * @param int $agentId
     * @param string $taskId
     * @param string $replaceName
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\WeChat\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     */
    public function updateTaskcard(array $userids, int $agentId, string $taskId, string $replaceName = '已收到')
    {
        $params = [
            'userids' => $userids,
            'agentid' => $agentId,
            'task_id' => $taskId,
            'replace_name' => $replaceName
        ];

        return $this->httpPostJson('cgi-bin/message/update_taskcard', $params);
    }
}

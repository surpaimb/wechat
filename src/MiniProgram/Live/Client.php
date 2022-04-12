<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\MiniProgram\Live;

use Surpaimb\WeChat\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author onekb <1@1kb.ren>
 */
class Client extends BaseClient
{
    /**
     * Get Room List.
     *
     * @param int $start
     * @param int $limit
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @deprecated This method has been merged into `\Surpaimb\WeChat\MiniProgram\Broadcast`
     */
    public function getRooms(int $start = 0, int $limit = 10)
    {
        $params = [
            'start' => $start,
            'limit' => $limit,
        ];

        return $this->httpPostJson('wxa/business/getliveinfo', $params);
    }

    /**
     * Get Playback List.
     *
     * @param int $roomId
     * @param int $start
     * @param int $limit
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @deprecated This method has been merged into `\Surpaimb\WeChat\MiniProgram\Broadcast`
     */
    public function getPlaybacks(int $roomId, int $start = 0, int $limit = 10)
    {
        $params = [
            'action' => 'get_replay',
            'room_id' => $roomId,
            'start' => $start,
            'limit' => $limit,
        ];

        return $this->httpPostJson('wxa/business/getliveinfo', $params);
    }
}

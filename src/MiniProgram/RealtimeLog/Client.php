<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\MiniProgram\RealtimeLog;

use Surpaimb\WeChat\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author her-cat <i@her-cat.com>
 */
class Client extends BaseClient
{
    /**
     * Real time log query.
     *
     * @param string $date
     * @param int    $beginTime
     * @param int    $endTime
     * @param array  $options
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(string $date, int $beginTime, int $endTime, array $options = [])
    {
        $params = [
            'date' => $date,
            'begintime' => $beginTime,
            'endtime' => $endTime,
        ];

        return $this->httpGet('wxaapi/userlog/userlog_search', $params + $options);
    }
}

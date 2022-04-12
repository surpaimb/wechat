<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\OfficialAccount\ShakeAround;

use Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Card.
 *
 * @author overtrue <i@overtrue.me>
 *
 * @property \Surpaimb\WeChat\OfficialAccount\ShakeAround\DeviceClient   $device
 * @property \Surpaimb\WeChat\OfficialAccount\ShakeAround\GroupClient    $group
 * @property \Surpaimb\WeChat\OfficialAccount\ShakeAround\MaterialClient $material
 * @property \Surpaimb\WeChat\OfficialAccount\ShakeAround\RelationClient $relation
 * @property \Surpaimb\WeChat\OfficialAccount\ShakeAround\StatsClient    $stats
 * @property \Surpaimb\WeChat\OfficialAccount\ShakeAround\PageClient     $page
 */
class ShakeAround extends Client
{
    /**
     * @param string $property
     *
     * @return mixed
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["shake_around.{$property}"])) {
            return $this->app["shake_around.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No shake_around service named "%s".', $property));
    }
}

<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat;

/**
 * Class Factory.
 *
 * @method static \Surpaimb\WeChat\Payment\Application            payment(array $config)
 * @method static \Surpaimb\WeChat\MiniProgram\Application        miniProgram(array $config)
 * @method static \Surpaimb\WeChat\OpenPlatform\Application       openPlatform(array $config)
 * @method static \Surpaimb\WeChat\OfficialAccount\Application    officialAccount(array $config)
 * @method static \Surpaimb\WeChat\BasicService\Application       basicService(array $config)
 * @method static \Surpaimb\WeChat\Work\Application               work(array $config)
 * @method static \Surpaimb\WeChat\OpenWork\Application           openWork(array $config)
 * @method static \Surpaimb\WeChat\MicroMerchant\Application      microMerchant(array $config)
 */
class Factory
{
    /**
     * @param string $name
     * @param array  $config
     *
     * @return \Surpaimb\WeChat\Kernel\ServiceContainer
     */
    public static function make($name, array $config)
    {
        $namespace = Kernel\Support\Str::studly($name);
        $application = "\\Surpaimb\\WeChat\\{$namespace}\\Application";

        return new $application($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}

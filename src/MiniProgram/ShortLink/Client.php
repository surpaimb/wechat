<?php

namespace Surpaimb\WeChat\MiniProgram\ShortLink;

use Surpaimb\WeChat\Kernel\BaseClient;
use Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException;
use Surpaimb\WeChat\Kernel\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client.
 *
 * @package Surpaimb\WeChat\MiniProgram\ShortLink
 *
 * @author 读心印 <aa24615@qq.com>
 */
class Client extends BaseClient
{
    /**
     * 获取小程序 Short Link
     *
     * @param  string  $pageUrl
     * @param  string  $pageTitle
     * @param  bool  $isPermanent
     *
     * @return array|Collection|object|ResponseInterface|string
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     */
    public function getShortLink(string $pageUrl, string $pageTitle, bool $isPermanent = false)
    {
        $params = [
            'page_url' => $pageUrl,
            'page_title' => $pageTitle,
            'is_permanent' => $isPermanent,
        ];

        return $this->httpPostJson('wxa/genwxashortlink', $params);
    }
}

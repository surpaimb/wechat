<?php

namespace Surpaimb\WeChat\MiniProgram\Shop\Delivery;

use Surpaimb\WeChat\Kernel\BaseClient;

/**
 * 自定义版交易组件及开放接口 - 物流接口
 *
 * @package Surpaimb\WeChat\MiniProgram\Shop\Delivery
 * @author HaoLiang <haoliang@qiyuankeji.cn>
 */
class Client extends BaseClient
{
    /**
     * 获取快递公司列表
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyList()
    {
        return $this->httpPostJson('shop/delivery/get_company_list');
    }

    /**
     * 订单发货
     *
     * @param array $order
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(array $order)
    {
        return $this->httpPostJson('shop/delivery/send', $order);
    }

    /**
     * 订单确认收货
     *
     * @param array $order
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function recieve(array $order)
    {
        return $this->httpPostJson('shop/delivery/recieve', $order);
    }
}

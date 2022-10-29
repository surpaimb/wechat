<?php

/*
 * This file is part of the overtrue/wechat.
 *
 */

namespace Surpaimb\WeChat\Channel\Window;

use Surpaimb\WeChat\Kernel\BaseClient;
use Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Client.
 *
 * @author surpaimb <surpaimb@126.com>
 */
class Client extends BaseClient
{
    /**
     * 上架商品到橱窗
     * 关于橱窗商品 ID 的说明
     * 不支持带货中心来源的商品，其余商品的橱窗商品 ID 与商品来源处的平台内部商品 ID 相同，对应关系如下
     * 商品来源	橱窗 ID 说明
     * 小商店	小商店商品的 product_id 字段
     * 视频号小店	视频号小店商品的 product_id 字段
     * 交易组件	组件商品的 product_id 字段
     * 
     * @param product_id	string(uint64)	是	橱窗商品ID
     * @param appid	string	是	商品来源店铺的appid
     * @param is_hide_for_window	bool	否	是否需要在个人橱窗页隐藏 (默认为false)
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function add(string $productId, string $appid, bool $is_hide_for_window = false)
    {
        $params = [
            'product_id' => $productId,
            'appid' => $appid,
            'is_hide_for_window' => $is_hide_for_window,
        ];

        return $this->httpPostJson('channels/ec/window/product/add', $params);
    }

    /**
     * 下架橱窗商品
     *
     * @param array $productId 商品编号信息
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function off(array $productId, string $appid)
    {
        $params = [
            'product_id' => $productId,
            'appid' => $appid,
        ];
        return $this->httpPostJson('channels/ec/window/product/off', $params);
    }

    /**
     * 获取橱窗商品详情
     *
     * @param array $productId 商品编号信息
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(array $productId, string $appid)
    {
        $params = [
            'product_id' => $productId,
            'appid' => $appid,
        ];
        return $this->httpPostJson('channels/ec/window/product/get', $params);
    }

    /**
     * 获取已添加到橱窗的商品列表
     *
     * @param string $appid 小程序APPID
     * @param array $page 分页信息
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getList(string $appid, array $page)
    {
        $params = [
            'appid' => $appid,
        ];
        return $this->httpPostJson('channels/ec/window/product/list/get', array_merge($params, $page));
    }
}

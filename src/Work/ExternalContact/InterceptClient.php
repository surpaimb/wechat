<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Work\ExternalContact;

use Surpaimb\WeChat\Kernel\BaseClient;

/**
 * Class InterceptClient.
 *
 * @package Surpaimb\WeChat\Work\ExternalContact
 *
 * @author 读心印 <aa24615@qq.com>
 */
class InterceptClient extends BaseClient
{
    /**
     * 新建敏感词规则.
     *
     * @see https://developer.work.weixin.qq.com/document/path/95097#新建敏感词规则
     *
     * @param array $params
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author 读心印 <aa24615@qq.com>
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function createInterceptRule(array $params)
    {
        return $this->httpPostJson('cgi-bin/externalcontact/add_intercept_rule', $params);
    }

    /**
     * 获取敏感词规则列表.
     *
     * @see https://developer.work.weixin.qq.com/document/path/95097#获取敏感词规则列表
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author 读心印 <aa24615@qq.com>
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function getInterceptRules()
    {
        return $this->httpGet('cgi-bin/externalcontact/get_intercept_rule_list');
    }

    /**
     * 获取敏感词规则详情.
     *
     * @see https://developer.work.weixin.qq.com/document/path/95097#获取敏感词规则详情
     *
     * @param string $ruleId
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author 读心印 <aa24615@qq.com>
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function getInterceptRuleDetails(string $ruleId)
    {
        $params = [
            'rule_id' => $ruleId
        ];

        return $this->httpPostJson('cgi-bin/externalcontact/get_intercept_rule', $params);
    }

    /**
     * 删除敏感词规则.
     *
     * @see https://developer.work.weixin.qq.com/document/path/95097#删除敏感词规则
     *
     * @param string $ruleId
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @author 读心印 <aa24615@qq.com>
     *
     * @return array|\Surpaimb\WeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function deleteInterceptRule(string $ruleId)
    {
        $params = [
            'rule_id' => $ruleId
        ];

        return $this->httpPostJson('cgi-bin/externalcontact/del_intercept_rule', $params);
    }
}

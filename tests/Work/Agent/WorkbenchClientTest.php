<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\Work\Agent;

use Surpaimb\WeChat\Tests\TestCase;
use Surpaimb\WeChat\Work\Agent\WorkbenchClient;

class WorkbenchClientTest extends TestCase
{
    public function testSetWorkBenchTemplate()
    {
        $client = $this->mockApiClient(WorkbenchClient::class);

        $params = [
            'agentid' => 1000005,
            'type' => 'image',
            'image' => [
                'url' => 'xxxx',
                'jump_url' => 'http://www.qq.com',
                'pagepath' => 'pages/index'
            ],
            'replace_user_data' => true
        ];

        $client->expects()->httpPostJson('cgi-bin/agent/set_workbench_template', $params)->andReturn('mock-result');

        $this->assertSame('mock-result', $client->setWorkbenchTemplate($params));
    }

    public function testGetWorkBenchTemplate()
    {
        $client = $this->mockApiClient(WorkbenchClient::class);

        $params = [
            'agentid' => 100001
        ];

        $client->expects()->httpPostJson('cgi-bin/agent/get_workbench_template', $params)->andReturn('mock-result');

        $this->assertSame('mock-result', $client->getWorkbenchTemplate(100001));
    }

    public function testSetWorkBenchData()
    {
        $client = $this->mockApiClient(WorkbenchClient::class);

        $params = [
            'agentid' => 1000005,
            'userid' => 'test',
            'type' => 'keydata',
            'keydata' => [
                    'items' => [
                    [
                        'key' => '待审批',
                        'data' => '2',
                        'jump_url' => 'http://www.qq.com',
                        'pagepath' => 'pages/index'
                    ],
                    [
                        'key' => '带批阅作业',
                        'data' => '4',
                        'jump_url' => 'http://www.qq.com',
                        'pagepath' => 'pages/index'
                    ],
                    [
                        'key' => '成绩录入',
                        'data' => '45',
                        'jump_url' => 'http://www.qq.com',
                        'pagepath' => 'pages/index'
                    ],
                    [
                        'key' => '综合评价',
                        'data' => '98',
                        'jump_url' => 'http://www.qq.com',
                        'pagepath' => 'pages/index'
                    ]
                ]
            ]
        ];

        $client->expects()->httpPostJson('cgi-bin/agent/set_workbench_data', $params)->andReturn('mock-result');

        $this->assertSame('mock-result', $client->setWorkbenchData($params));
    }
}

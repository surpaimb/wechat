<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Tests\Kernel\Log;

use Surpaimb\WeChat\Kernel\Config;
use Surpaimb\WeChat\Kernel\Log\LogManager;
use Surpaimb\WeChat\Kernel\ServiceContainer;
use Surpaimb\WeChat\Tests\TestCase;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Logger;

class LogManagerTest extends TestCase
{
    public function testStack()
    {
        $app = new ServiceContainer([], [
            'config' => new Config([
                'log' => [
                    'channels' => [
                        'stack' => [
                            'driver' => 'stack',
                            'channels' => ['errorlog', 'single'],
                        ],
                        'errorlog' => [
                            'driver' => 'errorlog',
                            'type' => ErrorLogHandler::OPERATING_SYSTEM,
                            'level' => 'debug',
                        ],
                        'single' => [
                            'driver' => 'single',
                            'path' => __DIR__.'/logs/easywechat.log',
                            'level' => 'debug',
                        ],
                    ],
                ],
            ]),
        ]);

        $log = new LogManager($app);

        $this->assertInstanceOf(ErrorLogHandler::class, $log->stack(['errorlog', 'single'])->getHandlers()[0]);
        $this->assertInstanceOf(ErrorLogHandler::class, $log->channel('stack')->getHandlers()[0]);
        $this->assertInstanceOf(ErrorLogHandler::class, $log->driver('stack')->getHandlers()[0]);
    }

    public function testResolveUndefinedDriver()
    {
        $app = new ServiceContainer([]);
        $log = \Mockery::mock(LogManager::class.'[createEmergencyLogger]', [$app])->shouldAllowMockingProtectedMethods();

        $emergencyLogger = \Mockery::mock(Logger::class);
        $log->shouldReceive('createEmergencyLogger')->andReturn($emergencyLogger);
        $emergencyLogger->shouldReceive('emergency')
            ->with('Unable to create configured logger. Using emergency logger.', \Mockery::on(function ($data) {
                $this->assertArrayHasKey('exception', $data);
                $this->assertInstanceOf(\InvalidArgumentException::class, $data['exception']);
                $this->assertSame('Log [bad-name] is not defined.', $data['exception']->getMessage());

                return true;
            }));
        $log->driver('bad-name');
    }

    public function testResolveCustomCreator()
    {
        $app = new ServiceContainer([], [
            'config' => new Config([
                'log' => [
                    'channels' => [
                        'custom' => [
                            'driver' => 'mylog',
                            'key' => 'value',
                            'level' => 'debug',
                        ],
                    ],
                ],
            ]),
        ]);

        $log = new LogManager($app);
        $log->extend('mylog', function () {
            return 'mylog';
        });

        $this->assertSame('mylog', $log->driver('custom'));
    }

    public function testUnsupportedDriver()
    {
        $app = new ServiceContainer([], [
            'config' => new Config([
                'log' => [
                    'channels' => [
                        'custom' => [
                            'driver' => 'abcde',
                            'key' => 'value',
                            'level' => 'debug',
                        ],
                    ],
                ],
            ]),
        ]);

        $log = \Mockery::mock(LogManager::class.'[createEmergencyLogger]', [$app])->shouldAllowMockingProtectedMethods();
        $emergencyLogger = \Mockery::mock(Logger::class);
        $log->shouldReceive('createEmergencyLogger')->andReturn($emergencyLogger);
        $emergencyLogger->shouldReceive('emergency')
            ->with('Unable to create configured logger. Using emergency logger.', \Mockery::on(function ($data) {
                $this->assertArrayHasKey('exception', $data);
                $this->assertInstanceOf(\InvalidArgumentException::class, $data['exception']);
                $this->assertSame('Driver [abcde] is not supported.', $data['exception']->getMessage());

                return true;
            }));
        $log->driver('custom');
    }

    public function testAgencyMethods()
    {
        $app = new ServiceContainer([], [
            'config' => new Config([
                'log' => [
                    'default' => 'single',
                    'channels' => [
                        'single' => [
                            'driver' => 'single',
                        ],
                    ],
                ],
            ]),
        ]);
        $log = \Mockery::mock(LogManager::class.'[createSingleDriver]', [$app])->shouldAllowMockingProtectedMethods();

        $logger = \Mockery::mock(Logger::class);

        $log->shouldReceive('createSingleDriver')->andReturn($logger);
        $logger->shouldReceive('emergency')->with('emergency message', []);
        $logger->shouldReceive('alert')->with('alert message', []);
        $logger->shouldReceive('critical')->with('critical message', []);
        $logger->shouldReceive('error')->with('error message', []);
        $logger->shouldReceive('warning')->with('warning message', []);
        $logger->shouldReceive('notice')->with('notice message', []);
        $logger->shouldReceive('info')->with('info message', []);
        $logger->shouldReceive('debug')->with('debug message', []);
        $logger->shouldReceive('log')->with('debug', 'log message', []);

        $log->emergency('emergency message');
        $log->alert('alert message');
        $log->critical('critical message');
        $log->error('error message');
        $log->warning('warning message');
        $log->notice('notice message');
        $log->info('info message');
        $log->debug('debug message');
        $log->log('debug', 'log message');
    }

    public function testSetDefaultDriver()
    {
        $app = new ServiceContainer([], [
            'config' => new Config([
                'log' => [
                    'channels' => [
                        'single' => [
                            'driver' => 'single',
                        ],
                    ],
                ],
            ]),
        ]);
        $log = \Mockery::mock(LogManager::class.'[createSingleDriver]', [$app])->shouldAllowMockingProtectedMethods();

        $logger = \Mockery::mock(Logger::class);

        $this->assertNull($log->getDefaultDriver());

        $log->setDefaultDriver('single');

        $log->shouldReceive('createSingleDriver')->andReturn($logger);
        $logger->shouldReceive('debug')->with('debug message', []);

        $log->debug('debug message');

        $this->assertSame('single', $log->getDefaultDriver());
    }

    public function testDriverCreators()
    {
        $app = new ServiceContainer([], [
            'config' => new Config([
                'log' => [
                    'channels' => [
                        'single' => [
                            'driver' => 'single',
                        ],
                    ],
                ],
            ]),
        ]);
        $log = \Mockery::mock(LogManager::class, [$app])
                ->shouldAllowMockingProtectedMethods()
                ->makePartial();

        $this->assertInstanceOf(Logger::class, $log->createStackDriver(['channels' => ['single']]));
        $this->assertInstanceOf(Logger::class, $log->createSlackDriver(['url' => 'https://easywechat.com']));
        $this->assertInstanceOf(Logger::class, $log->createDailyDriver(['path' => '/path/to/file.log']));
        $this->assertInstanceOf(Logger::class, $log->createSyslogDriver([]));
        $this->assertInstanceOf(Logger::class, $log->createErrorlogDriver([]));
    }

    public function testInvalidLevel()
    {
        $app = new ServiceContainer([]);
        $log = \Mockery::mock(LogManager::class, [$app])
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid log level.');

        $log->level([
            'level' => 'undefined',
        ]);
    }

    public function testCall()
    {
        $app = new ServiceContainer([]);
        $log = new LogManager($app);
        $this->assertIsArray($log->getHandlers());
    }
}

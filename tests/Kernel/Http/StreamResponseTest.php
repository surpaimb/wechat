<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Surpaimb\WeChat\Kernel\Http\StreamResponse;
use Surpaimb\WeChat\Tests\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamWrapper;

class StreamResponseTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('testing'));
    }

    public function testSave()
    {
        $response = new StreamResponse(200, [], file_get_contents(STUBS_ROOT.'/files/image.png'));
        $directory = vfsStream::url('testing');

        // default filename
        $filename = $response->save($directory);
        $this->assertTrue(vfsStreamWrapper::getRoot()->hasChild($filename));
        $this->assertStringEndsWith('.png', $filename);

        // custom filename
        $filename = $response->save($directory, 'custom-filename');
        $this->assertTrue(vfsStreamWrapper::getRoot()->hasChild($filename));
        $this->assertSame('custom-filename.png', $filename);

        // custom filename without auto suffix
        $filename = $response->save($directory, 'custom-filename', false);
        $this->assertTrue(vfsStreamWrapper::getRoot()->hasChild($filename));
        $this->assertSame('custom-filename', $filename);

        // get filename from header
        $response = new StreamResponse(200, ['Content-Disposition' => 'attachment; filename="filename.jpg"'], file_get_contents(STUBS_ROOT.'/files/image.png'));
        $filename = $response->save($directory);
        $this->assertTrue(vfsStreamWrapper::getRoot()->hasChild($filename));
        $this->assertSame('filename.jpg', $filename);

        // header without name
        $response = new StreamResponse(200, ['Content-Disposition' => 'attachment;'], file_get_contents(STUBS_ROOT.'/files/image.png'));
        $filename = $response->save($directory);
        $this->assertTrue(vfsStreamWrapper::getRoot()->hasChild($filename));
        $this->assertStringEndsWith('.png', $filename);

        // not writable
        $this->expectException(\Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage("'vfs://usr' is not writable.");
        vfsStream::setup('usr', 0444);
        $response->save(vfsStream::url('usr'));
    }

    public function testSaveWithEmptyContent()
    {
        // empty contents
        $directory = vfsStream::url('testing');
        $this->expectException(\Surpaimb\WeChat\Kernel\Exceptions\RuntimeException::class);
        $this->expectExceptionMessage('Invalid media response content.');
        $response = new StreamResponse(200, [], file_get_contents(STUBS_ROOT.'/files/empty.file'));
        $response->save($directory);
    }

    public function testSaveAs()
    {
        $response = Mockery::mock(StreamResponse::class.'[save]');
        $response->expects()->save('dir', 'filename', true)->andReturn('filename.png');
        $response->expects()->save('dir', 'filename', false)->andReturn('filename');

        $this->assertSame('filename.png', $response->saveAs('dir', 'filename'));

        // without auto suffix
        $this->assertSame('filename', $response->saveAs('dir', 'filename', false));
    }
}

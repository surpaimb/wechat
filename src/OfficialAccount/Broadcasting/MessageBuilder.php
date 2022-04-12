<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\OfficialAccount\Broadcasting;

use Surpaimb\WeChat\Kernel\Contracts\MessageInterface;
use Surpaimb\WeChat\Kernel\Exceptions\RuntimeException;

/**
 * Class MessageBuilder.
 *
 * @author overtrue <i@overtrue.me>
 */
class MessageBuilder
{
    /**
     * @var array
     */
    protected $to = [];

    /**
     * @var \Surpaimb\WeChat\Kernel\Contracts\MessageInterface
     */
    protected $message;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * Set message.
     *
     * @param \Surpaimb\WeChat\Kernel\Contracts\MessageInterface $message
     *
     * @return $this
     */
    public function message(MessageInterface $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set target user or group.
     *
     * @param array $to
     *
     * @return $this
     */
    public function to(array $to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @param int $tagId
     *
     * @return \Surpaimb\WeChat\OfficialAccount\Broadcasting\MessageBuilder
     */
    public function toTag(int $tagId)
    {
        $this->to([
            'filter' => [
                'is_to_all' => false,
                'tag_id' => $tagId,
            ],
        ]);

        return $this;
    }

    /**
     * @param array $openids
     *
     * @return \Surpaimb\WeChat\OfficialAccount\Broadcasting\MessageBuilder
     */
    public function toUsers(array $openids)
    {
        $this->to([
            'touser' => $openids,
        ]);

        return $this;
    }

    /**
     * @return $this
     */
    public function toAll()
    {
        $this->to([
            'filter' => ['is_to_all' => true],
        ]);

        return $this;
    }

    /**
     * @param array $attributes
     *
     * @return \Surpaimb\WeChat\OfficialAccount\Broadcasting\MessageBuilder
     */
    public function with(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Build message.
     *
     * @param array $prepends
     *
     * @return array
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\RuntimeException
     */
    public function build(array $prepends = []): array
    {
        if (empty($this->message)) {
            throw new RuntimeException('No message content to send.');
        }

        $content = $this->message->transformForJsonRequest();

        if (empty($prepends)) {
            $prepends = $this->to;
        }

        $message = array_merge($prepends, $content, $this->attributes);

        return $message;
    }

    /**
     * Build preview message.
     *
     * @param string $by
     * @param string $user
     *
     * @return array
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\RuntimeException
     */
    public function buildForPreview(string $by, string $user): array
    {
        return $this->build([$by => $user]);
    }
}

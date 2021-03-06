<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Work\Message;

use Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException;
use Surpaimb\WeChat\Kernel\Exceptions\RuntimeException;
use Surpaimb\WeChat\Kernel\Messages\Message;
use Surpaimb\WeChat\Kernel\Messages\Text;
use Surpaimb\WeChat\Kernel\Support\Arr;

/**
 * Class MessageBuilder.
 *
 * @author overtrue <i@overtrue.me>
 */
class Messenger
{
    /**
     * @var \Surpaimb\WeChat\Kernel\Messages\Message;
     */
    protected $message;

    /**
     * @var array
     */
    protected $to = ['touser' => '@all'];

    /**
     * @var int
     */
    protected $agentId;

    /**
     * @var bool
     */
    protected $secretive = false;

    /**
     * @var \Surpaimb\WeChat\Work\Message\Client
     */
    protected $client;

    /**
     * MessageBuilder constructor.
     *
     * @param \Surpaimb\WeChat\Work\Message\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Set message to send.
     *
     * @param string|Message $message
     *
     * @return \Surpaimb\WeChat\Work\Message\Messenger
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public function message($message)
    {
        if (is_string($message) || is_numeric($message)) {
            $message = new Text($message);
        }

        if (!($message instanceof Message)) {
            throw new InvalidArgumentException('Invalid message.');
        }

        $this->message = $message;

        return $this;
    }

    /**
     * @param int $agentId
     *
     * @return \Surpaimb\WeChat\Work\Message\Messenger
     */
    public function ofAgent(int $agentId)
    {
        $this->agentId = $agentId;

        return $this;
    }

    /**
     * @param array|string $userIds
     *
     * @return \Surpaimb\WeChat\Work\Message\Messenger
     */
    public function toUser($userIds)
    {
        return $this->setRecipients($userIds, 'touser');
    }

    /**
     * @param array|string $partyIds
     *
     * @return \Surpaimb\WeChat\Work\Message\Messenger
     */
    public function toParty($partyIds)
    {
        return $this->setRecipients($partyIds, 'toparty');
    }

    /**
     * @param array|string $tagIds
     *
     * @return \Surpaimb\WeChat\Work\Message\Messenger
     */
    public function toTag($tagIds)
    {
        return $this->setRecipients($tagIds, 'totag');
    }

    /**
     * Keep secret.
     *
     * @return \Surpaimb\WeChat\Work\Message\Messenger
     */
    public function secretive()
    {
        $this->secretive = true;

        return $this;
    }

    /**
     * verify recipient is '@all' or not
     *
     * @return bool
     */
    protected function isBroadcast(): bool
    {
        return Arr::get($this->to, 'touser') === '@all';
    }

    /**
     * @param array|string $ids
     * @param string       $key
     *
     * @return \Surpaimb\WeChat\Work\Message\Messenger
     */
    protected function setRecipients($ids, string $key): self
    {
        if (is_array($ids)) {
            $ids = implode('|', $ids);
        }

        $this->to = $this->isBroadcast() ? [$key => $ids] : array_merge($this->to, [$key => $ids]);

        return $this;
    }

    /**
     * @param \Surpaimb\WeChat\Kernel\Messages\Message|string|null $message
     *
     * @return mixed
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\RuntimeException
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public function send($message = null)
    {
        if ($message) {
            $this->message($message);
        }

        if (empty($this->message)) {
            throw new RuntimeException('No message to send.');
        }

        if (is_null($this->agentId)) {
            throw new RuntimeException('No agentid specified.');
        }

        $message = $this->message->transformForJsonRequest(array_merge([
            'agentid' => $this->agentId,
            'safe' => intval($this->secretive),
        ], $this->to));

        $this->secretive = false;

        return $this->client->send($message);
    }

    /**
     * Return property.
     *
     * @param string $property
     *
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        throw new InvalidArgumentException(sprintf('No property named "%s"', $property));
    }
}

<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\OfficialAccount\Card;

use Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Card.
 *
 * @author overtrue <i@overtrue.me>
 *
 * @property \Surpaimb\WeChat\OfficialAccount\Card\CodeClient          $code
 * @property \Surpaimb\WeChat\OfficialAccount\Card\MeetingTicketClient $meeting_ticket
 * @property \Surpaimb\WeChat\OfficialAccount\Card\MemberCardClient    $member_card
 * @property \Surpaimb\WeChat\OfficialAccount\Card\GeneralCardClient   $general_card
 * @property \Surpaimb\WeChat\OfficialAccount\Card\MovieTicketClient   $movie_ticket
 * @property \Surpaimb\WeChat\OfficialAccount\Card\CoinClient          $coin
 * @property \Surpaimb\WeChat\OfficialAccount\Card\SubMerchantClient   $sub_merchant
 * @property \Surpaimb\WeChat\OfficialAccount\Card\BoardingPassClient  $boarding_pass
 * @property \Surpaimb\WeChat\OfficialAccount\Card\JssdkClient         $jssdk
 * @property \Surpaimb\WeChat\OfficialAccount\Card\GiftCardClient      $gift_card
 * @property \Surpaimb\WeChat\OfficialAccount\Card\GiftCardOrderClient $gift_card_order
 * @property \Surpaimb\WeChat\OfficialAccount\Card\GiftCardPageClient  $gift_card_page
 * @property \Surpaimb\WeChat\OfficialAccount\Card\InvoiceClient       $invoice
 */
class Card extends Client
{
    /**
     * @param string $property
     *
     * @return mixed
     *
     * @throws \Surpaimb\WeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["card.{$property}"])) {
            return $this->app["card.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No card service named "%s".', $property));
    }
}

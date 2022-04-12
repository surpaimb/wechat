<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\WeChat\Test\OfficialAccount\Card;

use Surpaimb\WeChat\OfficialAccount\Application;
use Surpaimb\WeChat\OfficialAccount\Card\BoardingPassClient;
use Surpaimb\WeChat\OfficialAccount\Card\Card;
use Surpaimb\WeChat\OfficialAccount\Card\Client;
use Surpaimb\WeChat\OfficialAccount\Card\CodeClient;
use Surpaimb\WeChat\OfficialAccount\Card\CoinClient;
use Surpaimb\WeChat\OfficialAccount\Card\GeneralCardClient;
use Surpaimb\WeChat\OfficialAccount\Card\GiftCardClient;
use Surpaimb\WeChat\OfficialAccount\Card\GiftCardOrderClient;
use Surpaimb\WeChat\OfficialAccount\Card\GiftCardPageClient;
use Surpaimb\WeChat\OfficialAccount\Card\InvoiceClient;
use Surpaimb\WeChat\OfficialAccount\Card\JssdkClient;
use Surpaimb\WeChat\OfficialAccount\Card\MeetingTicketClient;
use Surpaimb\WeChat\OfficialAccount\Card\MemberCardClient;
use Surpaimb\WeChat\OfficialAccount\Card\MovieTicketClient;
use Surpaimb\WeChat\OfficialAccount\Card\SubMerchantClient;
use Surpaimb\WeChat\Tests\TestCase;

class CardTest extends TestCase
{
    public function testBasicProperties()
    {
        $app = new Application();
        $card = new Card($app);

        $this->assertInstanceOf(Client::class, $card);
        $this->assertInstanceOf(BoardingPassClient::class, $card->boarding_pass);
        $this->assertInstanceOf(MeetingTicketClient::class, $card->meeting_ticket);
        $this->assertInstanceOf(MovieTicketClient::class, $card->movie_ticket);
        $this->assertInstanceOf(CoinClient::class, $card->coin);
        $this->assertInstanceOf(MemberCardClient::class, $card->member_card);
        $this->assertInstanceOf(GeneralCardClient::class, $card->general_card);
        $this->assertInstanceOf(CodeClient::class, $card->code);
        $this->assertInstanceOf(SubMerchantClient::class, $card->sub_merchant);
        $this->assertInstanceOf(JssdkClient::class, $card->jssdk);
        $this->assertInstanceOf(GiftCardClient::class, $card->gift_card);
        $this->assertInstanceOf(GiftCardOrderClient::class, $card->gift_card_order);
        $this->assertInstanceOf(GiftCardPageClient::class, $card->gift_card_page);
        $this->assertInstanceOf(InvoiceClient::class, $card->invoice);

        try {
            $card->foo;
            $this->fail('No expected exception thrown.');
        } catch (\Exception $e) {
            $this->assertSame('No card service named "foo".', $e->getMessage());
        }
    }
}

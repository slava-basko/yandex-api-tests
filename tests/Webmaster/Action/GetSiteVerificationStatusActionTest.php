<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\Action;

use Yandex\Auth\Token;
use YandexWebmaster\Action\GetSiteVerificationStatusAction;
use YandexWebmaster\Auth\User;

class GetSiteVerificationStatusActionTest extends \PHPUnit_Framework_TestCase
{
    public function test_action()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $action = new GetSiteVerificationStatusAction($user, 'http:example.com:80');
        $this->assertEquals('/'.$user->getUserId().'/hosts/http:example.com:80/verification', $action->getUrl());
        $this->assertEquals('get', $action->getHttpMethod());
        $this->assertInstanceOf(Token::class, $action->getToken());
    }
}
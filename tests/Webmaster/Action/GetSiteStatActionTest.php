<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\Action;

use Yandex\Auth\Token;
use YandexWebmaster\Action\GetSiteStatAction;
use YandexWebmaster\Auth\User;

class GetSiteStatActionTest extends \PHPUnit_Framework_TestCase
{
    public function test_action()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $action = new GetSiteStatAction($user, 'http:example.com:80');
        $this->assertEquals('/'.$user->getUserId().'/hosts/http:example.com:80/summary', $action->getUrl());
        $this->assertEquals('get', $action->getHttpMethod());
        $this->assertInstanceOf(Token::class, $action->getToken());
    }
}
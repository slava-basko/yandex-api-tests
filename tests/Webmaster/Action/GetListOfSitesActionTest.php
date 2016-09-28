<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\Action;

use Yandex\Auth\Token;
use YandexWebmaster\Action\GetListOfSitesAction;
use YandexWebmaster\Auth\User;

class GetListOfSitesActionTest extends \PHPUnit_Framework_TestCase
{
    public function test_action()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $action = new GetListOfSitesAction($user);
        $this->assertEquals('/'.$user->getUserId().'/hosts', $action->getUrl());
        $this->assertEquals('get', $action->getHttpMethod());
        $this->assertInstanceOf(Token::class, $action->getToken());
    }
}
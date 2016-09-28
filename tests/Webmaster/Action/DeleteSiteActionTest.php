<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\Action;

use Yandex\Auth\Token;
use YandexWebmaster\Action\DeleteSiteAction;
use YandexWebmaster\Auth\User;

class DeleteSiteActionTest extends \PHPUnit_Framework_TestCase
{
    public function test_action()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $action = new DeleteSiteAction($user, 'http:example.com:80');
        $this->assertEquals('/'.$user->getUserId().'/hosts/http:example.com:80', $action->getUrl());
        $this->assertEquals('delete', $action->getHttpMethod());
        $this->assertInstanceOf(Token::class, $action->getToken());
    }
}
<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\Action;

use Yandex\Auth\Token;
use YandexWebmaster\Action\AddSiteAction;
use YandexWebmaster\Auth\User;

class AddSiteActionTest extends \PHPUnit_Framework_TestCase
{
    public function test_action()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $action = new AddSiteAction($user, 'example.com');
        $this->assertEquals('/'.$user->getUserId().'/hosts', $action->getUrl());
        $this->assertEquals('post', $action->getHttpMethod());
        $this->assertInstanceOf(Token::class, $action->getToken());
        $this->assertEquals('{"host_url":"example.com"}', $action->getBody());
    }
}
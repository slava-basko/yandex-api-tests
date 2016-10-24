<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 10/24/16
 */

namespace Yandex\Tests\Webmaster\Action;

use Yandex\Auth\Token;
use YandexWebmaster\Action\GetExternalLinksAction;
use YandexWebmaster\Auth\User;

class GetExternalLinksActionTest extends \PHPUnit_Framework_TestCase
{
    public function test_action()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $action = new GetExternalLinksAction($user, 'http:example.com:80');
        $this->assertEquals('/'.$user->getUserId().'/hosts/http:example.com:80/links/external/samples/?offset=0&limit=10', $action->getUrl());
        $this->assertEquals('get', $action->getHttpMethod());
        $this->assertInstanceOf(Token::class, $action->getToken());
    }

    public function test_action_negative_offset()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $this->setExpectedException(\InvalidArgumentException::class);
        new GetExternalLinksAction($user, 'http:example.com:80', -1);
    }

    public function test_action_negative_limit()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $this->setExpectedException(\InvalidArgumentException::class);
        new GetExternalLinksAction($user, 'http:example.com:80', 0, 0);
    }

    public function test_action_to_big_limit()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $this->setExpectedException(\InvalidArgumentException::class);
        new GetExternalLinksAction($user, 'http:example.com:80', 0, 101);
    }

    public function test_action_move_cursor()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];
        $action = new GetExternalLinksAction($user, 'http:example.com:80');

        $this->assertEquals('/'.$user->getUserId().'/hosts/http:example.com:80/links/external/samples/?offset=0&limit=10', $action->getUrl());
        $action->moveCursorToNextPage();
        $this->assertEquals('/'.$user->getUserId().'/hosts/http:example.com:80/links/external/samples/?offset=10&limit=10', $action->getUrl());
        $action->moveCursorToNextPage();
        $this->assertEquals('/'.$user->getUserId().'/hosts/http:example.com:80/links/external/samples/?offset=20&limit=10', $action->getUrl());
    }
}
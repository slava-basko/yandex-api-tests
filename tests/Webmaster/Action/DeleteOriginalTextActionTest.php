<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/29/16
 */

namespace Yandex\Tests\Webmaster\Action;

use Yandex\Auth\Token;
use YandexWebmaster\Action\DeleteOriginalTextAction;
use YandexWebmaster\Auth\User;

class DeleteOriginalTextActionTest extends \PHPUnit_Framework_TestCase
{
    public function test_action()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $action = new DeleteOriginalTextAction($user, 'http:example.com:80', 'text-id');
        $this->assertEquals('/'.$user->getUserId().'/hosts/http:example.com:80/original-texts/text-id', $action->getUrl());
        $this->assertEquals('delete', $action->getHttpMethod());
        $this->assertInstanceOf(Token::class, $action->getToken());
    }
}
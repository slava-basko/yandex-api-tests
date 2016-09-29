<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\Action;

use Yandex\Auth\Token;
use YandexWebmaster\Auth\User;
use YandexWebmaster\Action\AddOriginalTextAction;

class AddOriginalTextActionTest extends \PHPUnit_Framework_TestCase
{
    public function test_invalid_text_length()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $this->expectException(\InvalidArgumentException::class);
        new AddOriginalTextAction($user, 'http:example.com', 'qweqwe');
    }

    public function test_invalid_text_length_to_big()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $content = '';
        for ($i = 0; $i < 32001; $i++) {
            $content .= 'a';
        }

        $this->expectException(\InvalidArgumentException::class);
        new AddOriginalTextAction($user, 'http:example.com', $content);
    }

    public function test_action()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $content = '';
        for ($i = 0; $i < 600; $i++) {
            $content .= 'a';
        }

        $action = new AddOriginalTextAction($user, 'http:example.com', $content);
        $this->assertEquals('/'.$user->getUserId().'/hosts/http:example.com/original-texts', $action->getUrl());
        $this->assertEquals('post', $action->getHttpMethod());
        $this->assertInstanceOf(Token::class, $action->getToken());
        $this->assertInternalType('string', $action->getBody());
    }
}
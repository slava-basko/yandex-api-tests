<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\Auth;

use Yandex\Auth\Token;
use YandexWebmaster\Auth\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function test_user()
    {
        $user = new User(123, new Token('qwe'));
        $this->assertEquals(123, $user->getUserId());
        $this->assertInstanceOf(Token::class, $user->getToken());
    }
}
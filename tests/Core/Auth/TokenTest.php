<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/27/16
 */

namespace Yandex\Tests\Core\Auth;

use Yandex\Auth\Token;

class TokenTest extends \PHPUnit_Framework_TestCase
{
    const TOKEN = 'js8g-73nf-2jms8';

    public function test_token_creation()
    {
        $this->setExpectedException(\InvalidArgumentException::class);
        new Token(123);
    }

    public function test_token_to_string()
    {
        $token = new Token(self::TOKEN);
        $this->assertEquals(self::TOKEN, (string)$token);
    }
}
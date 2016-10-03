<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\Action;

use Yandex\Auth\Token;
use YandexWebmaster\Action\VerifySiteAction;
use YandexWebmaster\Auth\User;

class VerifySiteActionTest extends \PHPUnit_Framework_TestCase
{
    public function test_action()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $action = new VerifySiteAction($user, 'http:example.com:80', VerifySiteAction::VERIFICATION_TYPE_META_TAG);
        $this->assertEquals('/'.$user->getUserId().'/hosts/http:example.com:80/verification/?verification_type=META_TAG', $action->getUrl());
        $this->assertEquals('post', $action->getHttpMethod());
        $this->assertInstanceOf(Token::class, $action->getToken());
    }

    public function test_unsupported_type()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $this->setExpectedException('\InvalidArgumentException');
        new VerifySiteAction($user, 'http:example.com:80', 'QWE');
    }
}
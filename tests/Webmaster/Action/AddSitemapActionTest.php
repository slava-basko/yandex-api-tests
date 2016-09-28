<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\Action;

use Yandex\Auth\Token;
use YandexWebmaster\Action\AddSitemapAction;
use YandexWebmaster\Auth\User;

class AddSitemapActionTest extends \PHPUnit_Framework_TestCase
{
    public function test_action()
    {
        /**
         * @var User $user
         */
        $user = $GLOBALS['webmaster_user'];

        $action = new AddSitemapAction($user, 'http:example.com:80', 'example.com/sitemap.xml');
        $this->assertEquals('/'.$user->getUserId().'/hosts/http:example.com:80/user-added-sitemaps', $action->getUrl());
        $this->assertEquals('post', $action->getHttpMethod());
        $this->assertInstanceOf(Token::class, $action->getToken());
        $this->assertEquals('{"url":"example.com\/sitemap.xml"}', $action->getBody());
    }
}
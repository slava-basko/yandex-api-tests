<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/29/16
 */

namespace Yandex\Tests\Webmaster\ActionHandler;

use Yandex\Exception\ForbiddenException;
use Yandex\Exception\TooManyRequestsException;
use Yandex\Http\Response;
use YandexWebmaster\ActionHandler\AddOriginalTextActionHandler;
use YandexWebmaster\Value\OriginalText;

class AddOriginalTextActionHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_errors()
    {
        $handler = new AddOriginalTextActionHandler();
        $this->setExpectedException(ForbiddenException::class);
        $handler->handle(new Response(403, [], ''));
    }

    public function test_errors2()
    {
        $handler = new AddOriginalTextActionHandler();
        $this->setExpectedException(TooManyRequestsException::class);
        $handler->handle(new Response(429, [], ''));
    }

    public function test_success()
    {
        $handler = new AddOriginalTextActionHandler();
        $originalText = $handler->handle(new Response(201, [], '{"text_id": "some text","quota_remainder": 1}'));
        $this->assertInstanceOf(OriginalText::class, $originalText);
    }
}
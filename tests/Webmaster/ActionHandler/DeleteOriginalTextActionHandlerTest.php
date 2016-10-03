<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/29/16
 */

namespace Yandex\Tests\Webmaster\ActionHandler;

use Yandex\Exception\NotFoundException;
use Yandex\Http\Response;
use YandexWebmaster\ActionHandler\DeleteOriginalTextActionHandler;

class DeleteOriginalTextActionHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_success()
    {
        $response = new Response(204, [], '');
        $handler = new DeleteOriginalTextActionHandler();
        $this->assertTrue($handler->handle($response));
    }

    public function test_error()
    {
        $response = new Response(404, [], '{"error_code": "HOST_NOT_FOUND","host_id": "http:ya.ru:80","error_message": "explicit error message"}');
        $handler = new DeleteOriginalTextActionHandler();
        $this->setExpectedException(NotFoundException::class);
        $handler->handle($response);
    }
}
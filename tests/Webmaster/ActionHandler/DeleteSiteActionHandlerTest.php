<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\ActionHandler;

use Yandex\Http\Response;
use YandexWebmaster\ActionHandler\DeleteSiteActionHandler;
use YandexWebmaster\Exception\CanNotDeleteSiteException;

class DeleteSiteActionHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_success()
    {
        $response = new Response(204, [], '');
        $handler = new DeleteSiteActionHandler();
        $this->assertTrue($handler->handle($response));
    }

    public function test_error()
    {
        $response = new Response(404, [], '{"error_code": "HOST_NOT_FOUND","host_id": "http:ya.ru:80","error_message": "explicit error message"}');
        $handler = new DeleteSiteActionHandler();
        $this->expectException(CanNotDeleteSiteException::class);
        $handler->handle($response);
    }
}
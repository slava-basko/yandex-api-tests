<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\ActionHandler;

use Yandex\Exception\NotFoundException;
use Yandex\Http\Response;
use YandexWebmaster\ActionHandler\AddSitemapActionHandler;

class AddSitemapActionHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_success()
    {
        $response = new Response(201, [], '{"sitemap_id": "c7-fe:80-c0"}');
        $handler = new AddSitemapActionHandler();
        $this->assertEquals('c7-fe:80-c0', $handler->handle($response));
    }

    public function test_error()
    {
        $response = new Response(
            404,
            [],
            '{"error_code": "HOST_NOT_FOUND","host_id": "http:ya.ru:80","error_message": "explicit error message"}'
        );
        $handler = new AddSitemapActionHandler();
        $this->setExpectedException(NotFoundException::class);
        $handler->handle($response);
    }
}
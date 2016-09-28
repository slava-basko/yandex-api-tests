<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\ActionHandler;

use Yandex\Exception\BadResponseException;
use Yandex\Http\Response;
use YandexWebmaster\ActionHandler\AddSiteActionHandler;
use YandexWebmaster\Exception\CanNotAddSiteException;

class AddSiteActionHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_not_created()
    {
        $response = new Response(
            409,
            [],
            '{"error_code": "HOST_ALREADY_ADDED","host_id": "http:ya.ru:80","verified": false,"error_message": "explicit error message"}'
        );
        $handler = new AddSiteActionHandler();
        $this->expectException(CanNotAddSiteException::class);
        $handler->handle($response);
    }

    public function test_invalid_response()
    {
        $response = new Response(201, [], '{"asd": "zxc"}');
        $handler = new AddSiteActionHandler();
        $this->expectException(BadResponseException::class);
        $handler->handle($response);
    }
}
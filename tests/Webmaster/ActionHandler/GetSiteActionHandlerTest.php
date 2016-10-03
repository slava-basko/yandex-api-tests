<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\ActionHandler;

use Yandex\Exception\NotFoundException;
use Yandex\Http\Response;
use YandexWebmaster\ActionHandler\GetSiteActionHandler;
use YandexWebmaster\Value\Site;

class GetSiteActionHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_error()
    {
        $response = new Response(
            404,
            [],
            '{"error_code": "HOST_NOT_FOUND","host_id": "http:ya.ru:80","error_message": "explicit error message"}'
        );
        $handler = new GetSiteActionHandler();
        $this->setExpectedException(NotFoundException::class);
        $handler->handle($response);
    }

    public function test_success()
    {
        $response = new Response(
            200,
            [],
            '{
  "host_id": "https:ya.ru:443",
  "verified": true,
  "ascii_host_url": "https://ya.ru/",
  "unicode_host_url": "https://ya.ru/",
  "main_mirror": {
    "host_id": "http:xn--d1acpjx3f.xn--p1ai:80",
    "ascii_host_url": "http://xn--d1acpjx3f.xn--p1ai/",
    "unicode_host_url": "http://яндекс.рф/",
    "verified": false
  },
  "host_data_status": "NOT_INDEXED",
  "host_display_name": "Ya.ru"
}'
        );
        $handler = new GetSiteActionHandler();
        $this->assertInstanceOf(Site::class, $handler->handle($response));
    }
}
<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\ActionHandler;

use Yandex\Exception\YandexException;
use Yandex\Http\Response;
use YandexWebmaster\ActionHandler\GetListOfSitesHandler;
use YandexWebmaster\Value\Site;

class GetListOfSitesHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_success()
    {
        $response = new Response(
            200,
            [],
            '{
  "hosts": [
    {
      "host_id": "http:ya.ru:80",
      "ascii_host_url": "http://xn--d1acpjx3f.xn--p1ai/",
      "unicode_host_url": "http://яндекс.рф/",
      "verified": true,
      "main_mirror": {
        "host_id": "http:ya.ru:80",
        "verified": true,
        "ascii_host_url": "http://xn--d1acpjx3f.xn--p1ai/",
        "unicode_host_url": "http://яндекс.рф/"
      }
    }
  ]
}'
        );
        $handler = new GetListOfSitesHandler();
        $result = $handler->handle($response);

        $this->assertInternalType('array', $result);
        $this->assertArrayHasKey(0, $result);
        $this->assertInstanceOf(Site::class, $result[0]);
    }

    public function test_error()
    {
        $response = new Response(
            403,
            [],
            '{"error_code": "INVALID_USER_ID","available_user_id": 1,"error_message": "Invalid user id. {user_id} should be used."}'
        );
        $handler = new GetListOfSitesHandler();
        $this->expectException(YandexException::class);
        $handler->handle($response);
    }
}
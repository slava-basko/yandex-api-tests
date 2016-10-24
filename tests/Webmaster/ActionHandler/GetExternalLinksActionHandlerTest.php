<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 10/24/16
 */

namespace Yandex\Tests\Webmaster\ActionHandler;

use Yandex\Exception\ForbiddenException;
use Yandex\Http\Response;
use YandexWebmaster\ActionHandler\GetExternalLinksActionHandler;

class GetExternalLinksActionHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_error()
    {
        $response = new Response(
            403,
            [],
            '{"error_code": "INVALID_USER_ID","available_user_id": 1,"error_message": "Invalid user id. {user_id} should be used."}'
        );
        $handler = new GetExternalLinksActionHandler();
        $this->setExpectedException(ForbiddenException::class);
        $handler->handle($response);
    }

    public function test_success()
    {
        $response = new Response(
            200,
            [],
            '{
  "count": 1,
  "links": [
    {
      "source_url": "example.com",
      "destination_url": "example2.com",
      "discovery_date": "2016-01-01",
      "source_last_access_date": "2016-01-01"
    }
  ]
}'
        );
        $handler = new GetExternalLinksActionHandler();
        $linksCollection = $handler->handle($response);

        $this->assertEquals(1, $linksCollection->count());
        $this->assertEquals('example.com', $linksCollection->getLinks()[0]->getSourceUrl());
    }
}
<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\ActionHandler;

use Yandex\Exception\ForbiddenException;
use Yandex\Http\Response;
use YandexWebmaster\ActionHandler\DeleteSitemapActionHandler;

class DeleteSitemapActionHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_success()
    {
        $response = new Response(204, [], '');
        $handler = new DeleteSitemapActionHandler();
        $this->assertTrue($handler->handle($response));
    }

    public function test_error()
    {
        $response = new Response(
            403,
            [],
            '{
  "error_code": "INVALID_USER_ID",
  "available_user_id": 1,
  "error_message": "Invalid user id. {user_id} should be used."
}'
        );
        $handler = new DeleteSitemapActionHandler();
        $this->setExpectedException(ForbiddenException::class);
        $handler->handle($response);
    }
}
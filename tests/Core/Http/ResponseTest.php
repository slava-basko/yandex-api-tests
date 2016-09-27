<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/27/16
 */

namespace Yandex\Tests\Core\Http;

use Yandex\Http\Response;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public function test_values()
    {
        $response = new Response(201, [], 'content');
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals([], $response->getHeaders());
        $this->assertEquals('content', $response->getBody());
    }
}
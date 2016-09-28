<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Core\Utils;

use Yandex\Exception\JsonException;
use Yandex\Utils\Json;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    public function test_encode()
    {
        $this->assertEquals('{"qwe":"asd"}', Json::encode(['qwe' => 'asd']));
    }

    public function test_decode()
    {
        $this->assertEquals(['qwe' => 'asd'], Json::decode('{"qwe":"asd"}'));
    }

    public function test_invalid_json()
    {
        $this->expectException(JsonException::class);
        Json::decode('{"qwe":asd"}');
    }
}
<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\Http;

use Psr\Log\NullLogger;
use Yandex\Http\LoggableClient;
use YandexWebmaster\Http\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function test_instance()
    {
        $this->assertInstanceOf(\Yandex\Http\Client::class, Client::create('qwe', 'asd'));
    }

    public function test_loggable_instance()
    {
        $this->assertInstanceOf(LoggableClient::class, Client::create('qwe', 'asd', new NullLogger()));
    }
}
<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 11/14/16
 */

namespace Yandex\Tests\Core\Http;

use Yandex\Http\Curl;

class CurlTest extends \PHPUnit_Framework_TestCase
{
    public function test_headers()
    {
        $curl = new Curl();
        $curl->addHeader('Authorization', 'OAuth 123');
        $curl->addHeader('Authorization', 'OAuth 456');

        $reflectionObject = new \ReflectionObject($curl);
        $propertyHeaders = $reflectionObject->getProperty('headers');
        $propertyHeaders->setAccessible(true);
        $headers = $propertyHeaders->getValue($curl);

        $this->assertCount(1, $headers);
        $this->assertArrayHasKey('Authorization', $headers);
        $this->assertEquals('Authorization: OAuth 456', $headers['Authorization']);
    }
}
<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\Value;

use YandexWebmaster\Value\Site;

class SiteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Site
     */
    private $site;

    protected function setUp()
    {
        $this->site = new Site(
            'http:ya.ru:80',
            'http://xn--d1acpjx3f.xn--p1ai/',
            'http://яндекс.рф/',
            true,
            [],
            'NOT_INDEXED',
            'Ya.ru'
        );
    }

    public function test_instance()
    {
        $this->assertInstanceOf(Site::class, $this->site);
    }

    public function test_values()
    {
        $this->assertEquals('http:ya.ru:80', $this->site->getHostId());
        $this->assertEquals('http://xn--d1acpjx3f.xn--p1ai/', $this->site->getAsciiHostUrl());
        $this->assertEquals('http://яндекс.рф/', $this->site->getUnicodeHostUrl());
        $this->assertEquals(true, $this->site->getVerified());
        $this->assertEquals([], $this->site->getMainMirror());
        $this->assertEquals('NOT_INDEXED', $this->site->getHostDataStatus());
        $this->assertEquals('Ya.ru', $this->site->getHostDisplayName());
    }

    public function test_from_array()
    {
        $site = Site::fromArray([
            'host_id' => '',
            'ascii_host_url' => '',
            'unicode_host_url' => '',
            'verified' => '',
            'main_mirror' => '',
            'host_data_status' => '',
            'host_display_name' => ''
        ]);
        $this->assertInstanceOf(Site::class, $site);
    }
}
<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\Value;

use YandexWebmaster\Value\SiteStat;

class SiteStatTest extends \PHPUnit_Framework_TestCase
{
    public function test_value_object()
    {
        $siteStat = new SiteStat(
            80,
            100,
            20,
            100,
            1
        );

        $this->assertInstanceOf(SiteStat::class, $siteStat);
        $this->assertEquals(80, $siteStat->getTic());
        $this->assertEquals(100, $siteStat->getDownloadedPagesCount());
        $this->assertEquals(20, $siteStat->getExcludedPagesCount());
        $this->assertEquals(100, $siteStat->getSearchablePagesCount());
        $this->assertEquals(1, $siteStat->getSiteProblems());
    }
}
<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Webmaster\Value;

use YandexWebmaster\Value\SiteOwner;

class SiteOwnerTest extends \PHPUnit_Framework_TestCase
{
    public function test_value_object()
    {
        $siteOwner = new SiteOwner(
            'login',
            'qwe123',
            'META_TAG',
            '2016-09-28'
        );

        $this->assertInstanceOf(SiteOwner::class, $siteOwner);
        $this->assertEquals('login', $siteOwner->getUserLogin());
        $this->assertEquals('qwe123', $siteOwner->getVerificationUin());
        $this->assertEquals('META_TAG', $siteOwner->getVerificationType());
        $this->assertInstanceOf(\DateTime::class, $siteOwner->getVerificationDate());
        $this->assertEquals('2016-09-28', $siteOwner->getVerificationDate()->format('Y-m-d'));
    }
}
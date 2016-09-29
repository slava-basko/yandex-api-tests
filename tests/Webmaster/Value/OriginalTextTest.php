<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/29/16
 */

namespace Yandex\Tests\Webmaster\Value;

use YandexWebmaster\Value\OriginalText;

class OriginalTextTest extends \PHPUnit_Framework_TestCase
{
    public function test_value_object()
    {
        $originalText = new OriginalText('qwe', 5);
        $this->assertEquals('qwe', $originalText->getTextId());
        $this->assertEquals(5, $originalText->getQuotaRemainder());
    }
}
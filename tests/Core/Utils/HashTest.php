<?php
/**
 * Created by Slava Basko <basko.slava@gmail.com>
 * Date: 9/28/16
 */

namespace Yandex\Tests\Core\Utils;

use Yandex\Utils\Hash;

class HashTest extends \PHPUnit_Framework_TestCase
{
    public function test_get_one()
    {
        $this->assertEquals(123, Hash::get(['qwe' => 123], 'qwe'));
    }

    public function test_get_two()
    {
        $this->assertEquals(123, Hash::get(['qwe' => ['asd' => 123]], 'qwe.asd'));
    }

    public function test_get_three()
    {
        $this->assertEquals(123, Hash::get(['qwe' => ['asd' => ['zxc' => 123]]], 'qwe.asd.zxc'));
    }

    public function test_get_long()
    {
        $this->assertEquals(123, Hash::get([
            'qwe' => [
                'asd' => [
                    'zxc' => [
                        'rty' => [
                            'rty' => 123
                        ]
                    ]
                ]
            ]
        ], 'qwe.asd.zxc.rty.rty'));
    }
}
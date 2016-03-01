<?php
/*
 * Copyright (c) 2015 Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\Realtype\Test;

use PHPUnit_Framework_TestCase;
use Tebru\Realtype\Realtype;

/**
 * Class RealtypeTest
 *
 * @author Nate Brunette <n@tebru.net>
 */
class RealtypeTest extends PHPUnit_Framework_TestCase
{
    public function testWithNotString()
    {
        $this->assertSame(2.2, Realtype::get(2.2));
    }

    public function testWithZero()
    {
        $this->assertTrue('integer' === gettype(Realtype::get('0')));
        $this->assertSame(0, Realtype::get('0'));
    }

    public function testIsDouble()
    {
        $this->assertTrue('double' === gettype(Realtype::get('2.2')));
        $this->assertSame(2.2, Realtype::get('2.2'));
    }

    public function testIsDoubleZeroDecimal()
    {
        $this->assertTrue('double' === gettype(Realtype::get('2.0')));
        $this->assertSame(2.0, Realtype::get('2.0'));
    }

    public function testIsInt()
    {
        $this->assertTrue('integer' === gettype(Realtype::get('2')));
        $this->assertSame(2, Realtype::get('2'));
    }

    public function testIsBoolTrue()
    {
        $this->assertTrue('boolean' === gettype(Realtype::get(true)));
        $this->assertTrue(Realtype::get(true));
    }

    public function testIsBoolFalse()
    {
        $this->assertTrue('boolean' === gettype(Realtype::get('false')));
        $this->assertFalse(Realtype::get('false'));
    }

    public function testIsString()
    {
        $this->assertTrue('string' === gettype(Realtype::get('0xDEADBEEF')));
        $this->assertSame('0xDEADBEEF', Realtype::get('0xDEADBEEF'));
    }

    public function testStringStartingWithInt()
    {
        $this->assertTrue('string' === gettype(Realtype::get('101 Dalmations')));
        $this->assertSame('101 Dalmations', Realtype::get('101 Dalmations'));
    }
}

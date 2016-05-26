<?php
/*
 * Copyright (c) Nate Brunette.
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
        self::assertSame(2.2, Realtype::get(2.2));
    }

    public function testWithZero()
    {
        self::assertSame('integer', gettype(Realtype::get('0')));
        self::assertSame(0, Realtype::get('0'));
    }

    public function testIsDouble()
    {
        self::assertSame('double', gettype(Realtype::get('2.2')));
        self::assertSame(2.2, Realtype::get('2.2'));
    }

    public function testIsDoubleZeroDecimal()
    {
        self::assertSame('double', gettype(Realtype::get('2.0')));
        self::assertSame(2.0, Realtype::get('2.0'));
    }

    public function testIsDoubleNoPrecedingDigit()
    {
        self::assertSame('double', gettype(Realtype::get('.2')));
        self::assertSame(0.2, Realtype::get('.2'));
    }

    public function testIsDoubleNoFollowingDigit()
    {
        self::assertSame('double', gettype(Realtype::get('2.')));
        self::assertSame(2.0, Realtype::get('2.'));
    }

    public function testIsInt()
    {
        self::assertSame('integer', gettype(Realtype::get('2')));
        self::assertSame(2, Realtype::get('2'));
    }

    public function testIsBoolTrue()
    {
        self::assertSame('boolean', gettype(Realtype::get(true)));
        self::assertTrue(Realtype::get(true));
    }

    public function testIsBoolFalse()
    {
        self::assertSame('boolean', gettype(Realtype::get('false')));
        self::assertFalse(Realtype::get('false'));
    }

    public function testIsNullTrue()
    {
        self::assertSame('NULL', gettype(Realtype::get('null')));
        self::assertNull(Realtype::get('null'));
    }

    public function testIsString()
    {
        self::assertSame('string', gettype(Realtype::get('0xDEADBEEF')));
        self::assertSame('0xDEADBEEF', Realtype::get('0xDEADBEEF'));
    }

    public function testStringStartingWithInt()
    {
        self::assertSame('string', gettype(Realtype::get('101 Dalmations')));
        self::assertSame('101 Dalmations', Realtype::get('101 Dalmations'));
    }
}

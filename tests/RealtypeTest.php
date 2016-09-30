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

    public function testIsDoubleNegative()
    {
        self::assertSame('double', gettype(Realtype::get('-2.2')));
        self::assertSame(-2.2, Realtype::get('-2.2'));
    }

    public function testIsDoubleZeroDecimal()
    {
        self::assertSame('double', gettype(Realtype::get('2.0')));
        self::assertSame(2.0, Realtype::get('2.0'));
    }

    public function testIsDoubleZeroPrecedingDigit()
    {
        self::assertSame('double', gettype(Realtype::get('0.2')));
        self::assertSame(0.2, Realtype::get('0.2'));
    }

    public function testIsDoubleNoPrecedingDigit()
    {
        self::assertSame('double', gettype(Realtype::get('.2')));
        self::assertSame(0.2, Realtype::get('.2'));
    }

    public function testIsDoubleScientific()
    {
        self::assertSame('double', gettype(Realtype::get('2.2e10')));
        self::assertSame(2.2e10, Realtype::get('2.2e10'));
    }

    public function testIsDoubleScientificCapital()
    {
        self::assertSame('double', gettype(Realtype::get('2.2E10')));
        self::assertSame(2.2e10, Realtype::get('2.2E10'));
    }

    public function testIsDoubleScientificSignPositive()
    {
        self::assertSame('double', gettype(Realtype::get('2.2e+10')));
        self::assertSame(2.2e10, Realtype::get('2.2e+10'));
    }

    public function testIsDoubleScientificSignNegative()
    {
        self::assertSame('double', gettype(Realtype::get('2.2e-10')));
        self::assertSame(2.2e-10, Realtype::get('2.2e-10'));
    }

    public function testIsDoubleScientificSignNegativeInt()
    {
        self::assertSame('double', gettype(Realtype::get('2e-10')));
        self::assertSame(2e-10, Realtype::get('2e-10'));
    }

    public function testIsInt()
    {
        self::assertSame('integer', gettype(Realtype::get('2')));
        self::assertSame(2, Realtype::get('2'));
    }

    public function testIsIntNegative()
    {
        self::assertSame('integer', gettype(Realtype::get('-2')));
        self::assertSame(-2, Realtype::get('-2'));
    }

    public function testIsIntScientific()
    {
        self::assertSame('integer', gettype(Realtype::get('2e10')));
        self::assertSame((int) 2e10, Realtype::get('2e10'));
    }

    public function testIsIntScientificCapital()
    {
        self::assertSame('integer', gettype(Realtype::get('2E10')));
        self::assertSame((int) 2e10, Realtype::get('2E10'));
    }

    public function testIsIntScientificPositive()
    {
        self::assertSame('integer', gettype(Realtype::get('2e+10')));
        self::assertSame((int) 2e10, Realtype::get('2e+10'));
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

    public function testDigitless()
    {
        self::assertSame('string', gettype(Realtype::get('-')));
        self::assertSame('-', Realtype::get('-'));
    }

    public function testEndingDecimal()
    {
        self::assertSame('string', gettype(Realtype::get('2.')));
        self::assertSame('2.', Realtype::get('2.'));
    }

    public function testScientificNoEndingDigit()
    {
        self::assertSame('string', gettype(Realtype::get('2e+')));
        self::assertSame('2e+', Realtype::get('2e+'));
    }

    public function testScientificInvalidSign()
    {
        self::assertSame('string', gettype(Realtype::get('2e=2')));
        self::assertSame('2e=2', Realtype::get('2e=2'));
    }
}

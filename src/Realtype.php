<?php
/*
 * Copyright (c) 2015 Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\Realtype;

/**
 * Class Realtype
 *
 * @author Nate Brunette <n@tebru.net>
 */
class Realtype
{
    /**
     * Get the real type from a string
     *
     * @param string $var
     * @return bool|float|int|string
     */
    public static function get($var)
    {
        // this function is only useful for values in strings
        if (!is_string($var)) {
            return $var;
        }

        // if the string is '0', it's an int
        if ('0' === $var) {
            return 0;
        }

        if (self::isDouble($var)) {
            return floatval($var);
        }

        if (self::isInt($var)) {
            return intval($var);
        }

        if (self::isBool($var)) {
            return ('true' === $var) ? true : false;
        }

        // if we've gotten this far, it's a string
        return $var;
    }

    /**
     * Check if var is boolean
     *
     * 1. Do a check if the floatval() is 0, if so it's not a double
     * 2. Check if the intval() is the same as the floatval()
     * 2a. If they are the same, check if there's a decimal, if so it probably ends in .0
     *
     * @param string $var
     * @return bool
     */
    private static function isDouble($var)
    {
        return (bool)preg_match('/^\d*\.\d*$/', $var);
    }

    /**
     * Check if var is an int
     *
     * Only does an extra check for 0 after cast
     *
     * @param string $var
     * @return bool
     */
    private static function isInt($var)
    {
        return (bool)preg_match('/^\d+$/', $var);
    }

    /**
     * Check if 'true' or 'false' is that value of var
     *
     * @param string $var
     * @return bool
     */
    private static function isBool($var)
    {
        if ('true' === $var || 'false' === $var) {
            return true;
        }

        return false;
    }
}

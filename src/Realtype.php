<?php
/*
 * Copyright (c) Nate Brunette.
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

        if (self::isInt($var)) {
            // cast to float first in case we're using scientific notation
            $var = (float) $var;

            return (int) $var;
        }

        if (self::isDouble($var)) {
            return (float) $var;
        }


        if (self::isBool($var)) {
            return 'true' === $var;
        }

        if (self::isNull($var)) {
            return null;
        }

        // if we've gotten this far, it's a string
        return $var;
    }

    /**
     * Check if var is double
     *
     * @param string $var
     * @return bool
     */
    private static function isDouble($var)
    {
        return (bool) preg_match('/^-?(?:\d+|\d+\.\d+|\.\d+)(?:[eE][+-]?\d+)?$/', $var);
    }

    /**
     * Check if var is an int
     *
     * @param string $var
     * @return bool
     */
    private static function isInt($var)
    {
        return (bool) preg_match('/^-?\d+(?:[eE]\+?\d+)?$/', $var);
    }

    /**
     * Check if 'true' or 'false' is that value of var
     *
     * @param string $var
     * @return bool
     */
    private static function isBool($var)
    {
        return 'true' === $var || 'false' === $var;
    }

    /**
     * Check if var is null
     *
     * @param string $var
     * @return bool
     */
    private static function isNull($var)
    {
        return 'null' === $var;
    }
}

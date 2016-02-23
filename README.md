# Realtype

A PHP library that gets the real type from a string.  Sometimes doubles, integers, or booleans will exist inside a string.
This library determines what type it really is and returns that.

## Installation

    composer require tebru/realtype

## Usage

    \Tebru\Realtype\Realtype::get('2.2'); // returns 2.2
    \Tebru\Realtype\Realtype::get('2.0'); // returns 2.0
    \Tebru\Realtype\Realtype::get('2'); // returns 2
    \Tebru\Realtype\Realtype::get('0'); // returns 0
    \Tebru\Realtype\Realtype::get('true'); // returns true
    \Tebru\Realtype\Realtype::get('false'); // returns false
    \Tebru\Realtype\Realtype::get('string'); // returns 'string'
    \Tebru\Realtype\Realtype::get(2.2); // returns 2.2

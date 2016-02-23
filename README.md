[![Build Status](https://travis-ci.org/tebru/realtype.svg?branch=master)](https://travis-ci.org/tebru/realtype)
[![Coverage Status](https://coveralls.io/repos/github/tebru/realtype/badge.svg?branch=master)](https://coveralls.io/github/tebru/realtype?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/tebru/realtype/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/tebru/realtype/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/9fd39ca0-d83e-47f9-8c06-96656ab1461c/mini.png)](https://insight.sensiolabs.com/projects/9fd39ca0-d83e-47f9-8c06-96656ab1461c)

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

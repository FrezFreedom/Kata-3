<?php

class NumberToWordConvertor
{
    private const ONES = [
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
    ];

    public function intToWord(int $number): string
    {
        if ( key_exists($number, self::ONES) )
        {
            return self::ONES[$number];
        }

        throw new InvalidArgumentException('Invalid number');
    }
}
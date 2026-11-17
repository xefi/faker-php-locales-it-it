<?php

namespace Xefi\Faker\ItIt\Calculators;

class CheckCharacter
{
    /**
     * Values of the characters in odd positions (first, third, ...).
     *
     * @var array<string, int>
     */
    protected const ODD_VALUES = [
        '0' => 1, '1' => 0, '2' => 5, '3' => 7, '4' => 9, '5' => 13, '6' => 15, '7' => 17, '8' => 19, '9' => 21,
        'A' => 1, 'B' => 0, 'C' => 5, 'D' => 7, 'E' => 9, 'F' => 13, 'G' => 15, 'H' => 17, 'I' => 19, 'J' => 21,
        'K' => 2, 'L' => 4, 'M' => 18, 'N' => 20, 'O' => 11, 'P' => 3, 'Q' => 6, 'R' => 8, 'S' => 12, 'T' => 14,
        'U' => 16, 'V' => 10, 'W' => 22, 'X' => 25, 'Y' => 24, 'Z' => 23,
    ];

    /**
     * Compute the check character shared by the codice fiscale and the CIN of an Italian BBAN.
     *
     * @param string $value Uppercase alphanumeric string
     *
     * @return string
     */
    public static function compute(string $value): string
    {
        $sum = 0;

        foreach (str_split($value) as $index => $character) {
            $sum += $index % 2 === 0 ? self::ODD_VALUES[$character] : self::evenValue($character);
        }

        return chr(ord('A') + $sum % 26);
    }

    /**
     * Value of a character in an even position: digits keep their value, letters count from A = 0.
     *
     * @param string $character
     *
     * @return int
     */
    protected static function evenValue(string $character): int
    {
        return ctype_digit($character) ? (int) $character : ord($character) - ord('A');
    }
}

<?php

namespace Xefi\Faker\ItIt\Tests\Unit;

use Xefi\Faker\Calculators\Iban;

final class FinancialExtensionTest extends TestCase
{
    public function testIban(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $iban = $this->faker->iban();

            $this->assertMatchesRegularExpression('/^IT\d{2}[A-Z]\d{22}$/', $iban);
            $this->assertTrue(Iban::isValid($iban));
            $this->assertSame($this->expectedCheckCharacter(substr($iban, 5)), $iban[4], 'The CIN should be valid.');
        }
    }

    private function expectedCheckCharacter(string $value): string
    {
        $odd = [
            '0' => 1, '1' => 0, '2' => 5, '3' => 7, '4' => 9, '5' => 13, '6' => 15, '7' => 17, '8' => 19, '9' => 21,
            'A' => 1, 'B' => 0, 'C' => 5, 'D' => 7, 'E' => 9, 'F' => 13, 'G' => 15, 'H' => 17, 'I' => 19, 'J' => 21,
            'K' => 2, 'L' => 4, 'M' => 18, 'N' => 20, 'O' => 11, 'P' => 3, 'Q' => 6, 'R' => 8, 'S' => 12, 'T' => 14,
            'U' => 16, 'V' => 10, 'W' => 22, 'X' => 25, 'Y' => 24, 'Z' => 23,
        ];
        $even = array_merge(array_combine(range('0', '9'), range(0, 9)), array_combine(range('A', 'Z'), range(0, 25)));

        $sum = 0;
        for ($i = 0; $i < strlen($value); $i++) {
            $sum += $i % 2 === 0 ? $odd[$value[$i]] : $even[$value[$i]];
        }

        return range('A', 'Z')[$sum % 26];
    }
}

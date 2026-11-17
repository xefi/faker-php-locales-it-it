<?php

namespace Xefi\Faker\ItIt\Extensions;

use Xefi\Faker\Extensions\FinancialExtension as BaseFinancialExtension;
use Xefi\Faker\ItIt\Calculators\CheckCharacter;

class FinancialExtension extends BaseFinancialExtension
{
    public function getLocale(): ?string
    {
        return 'it_IT';
    }

    /**
     * Return an Italian IBAN: CIN check letter, ABI (5 digits), CAB (5 digits) and a 12-digit account number.
     *
     * @param ?string $countryCode
     * @param ?string $format      [{d} => digit, {l} => letter, {a} => any]
     *
     * @return string
     */
    public function iban(?string $countryCode = 'IT', ?string $format = null): string
    {
        if ($format === null) {
            $bban = $this->formatString(str_repeat('{d}', 5).str_repeat('{d}', 5).str_repeat('{d}', 12));
            $format = CheckCharacter::compute($bban).$bban;
        }

        return parent::iban($countryCode, $format);
    }
}

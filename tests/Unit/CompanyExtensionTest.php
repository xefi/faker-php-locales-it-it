<?php

namespace Xefi\Faker\ItIt\Tests\Unit;

use Random\Randomizer;
use Xefi\Faker\ItIt\Extensions\CompanyExtension;

final class CompanyExtensionTest extends TestCase
{
    protected array $companies = [];

    protected function setUp(): void
    {
        parent::setUp();

        $companyExtension = new CompanyExtension(new Randomizer());
        $this->companies = (new \ReflectionClass($companyExtension))->getProperty('companies')->getValue($companyExtension);
    }

    public function testCompany(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->companies); $i++) {
            $results[] = $this->faker->unique()->company();
        }

        $this->assertEqualsCanonicalizing($this->companies, $results);
    }

    public function testPartitaIva(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $partitaIva = $this->faker->partitaIva();

            $this->assertMatchesRegularExpression('/^\d{7}(0\d{2}|100)\d$/', $partitaIva);
            $this->assertTrue($this->isValidPartitaIva($partitaIva), "The partita IVA '{$partitaIva}' should have a valid check digit.");
        }
    }

    public function testVat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $vat = $this->faker->vat();

            $this->assertMatchesRegularExpression('/^IT\d{11}$/', $vat);
            $this->assertTrue($this->isValidPartitaIva(substr($vat, 2)));
        }
    }

    private function isValidPartitaIva(string $partitaIva): bool
    {
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $digit = (int) $partitaIva[$i];

            if ($i % 2 === 1) {
                $digit *= 2;
                $digit = $digit > 9 ? $digit - 9 : $digit;
            }

            $sum += $digit;
        }

        return (10 - $sum % 10) % 10 === (int) $partitaIva[10];
    }
}

<?php

namespace Xefi\Faker\ItIt\Tests\Unit;

final class PhoneExtensionTest extends TestCase
{
    public function testPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^(0\d{9}|3\d{9})$/', $this->faker->phoneNumber());
        }
    }

    public function testLandlinePhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^(0[26] \d{4} \d{4}|0\d{2} \d{3} \d{4})$/', $this->faker->spacedLandlinePhoneNumber());
        }
    }

    public function testCellPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^3[234689]\d \d{3} \d{4}$/', $this->faker->spacedCellPhoneNumber());
        }
    }

    public function testIndicatoredPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\+39(0\d{9}|3\d{9})$/', $this->faker->indicatoredPhoneNumber());
        }
    }

    public function testIndicatorIsSeparatedFromTheNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertStringStartsWith('+39 ', $this->faker->spacedIndicatoredPhoneNumber());
            $this->assertStringStartsWith('+39-', $this->faker->dashedIndicatoredPhoneNumber());
            $this->assertStringStartsWith('+39.', $this->faker->dottedIndicatoredPhoneNumber());
            $this->assertMatchesRegularExpression('/^\+39\d+$/', $this->faker->indicatoredPhoneNumber());
        }
    }
}

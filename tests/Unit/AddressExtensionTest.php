<?php

namespace Xefi\Faker\ItIt\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\ItIt\Extensions\AddressExtension;

final class AddressExtensionTest extends TestCase
{
    protected array $provinces = [];
    protected array $regions = [];
    protected array $cities = [];
    protected array $streetTypes = [];
    protected array $streetNames = [];

    protected function setUp(): void
    {
        parent::setUp();

        $addressExtension = new AddressExtension(new Randomizer());
        $reflection = new ReflectionClass($addressExtension);

        $this->provinces = $reflection->getProperty('provinces')->getValue($addressExtension);
        $this->regions = $reflection->getProperty('regions')->getValue($addressExtension);
        $this->cities = $reflection->getProperty('cities')->getValue($addressExtension);
        $this->streetTypes = $reflection->getProperty('streetTypes')->getValue($addressExtension);
        $this->streetNames = $reflection->getProperty('streetNames')->getValue($addressExtension);
    }

    public function testRegion(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->regions); $i++) {
            $results[] = $this->faker->unique()->region();
        }

        $this->assertEqualsCanonicalizing($this->regions, $results);
    }

    public function testProvince(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->provinces); $i++) {
            $results[] = $this->faker->unique()->province();
        }

        $this->assertEqualsCanonicalizing(array_keys($this->provinces), $results);
    }

    public function testProvinceCode(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->provinces); $i++) {
            $results[] = $this->faker->unique()->provinceCode();
        }

        $this->assertEqualsCanonicalizing(array_values($this->provinces), $results);

        foreach ($results as $result) {
            $this->assertMatchesRegularExpression('/^[A-Z]{2}$/', $result);
        }
    }

    public function testCity(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->cities); $i++) {
            $results[] = $this->faker->unique()->city();
        }

        $this->assertEqualsCanonicalizing(array_keys($this->cities), $results);
    }

    public function testPostcode(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\d{5}$/', $this->faker->postcode());
        }
    }

    public function testHouseNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->houseNumber();

            $this->assertIsInt($result);
            $this->assertGreaterThanOrEqual(1, $result);
            $this->assertLessThanOrEqual(250, $result);
        }
    }

    public function testStreetName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$type, $name] = explode(' ', $this->faker->streetName(), 2);

            $this->assertContains($type, $this->streetTypes);
            $this->assertContains($name, $this->streetNames);
        }
    }

    public function testStreetAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression("/^[\p{L}\d' ]+ \d{1,3}$/u", $this->faker->streetAddress());
        }
    }

    public function testFullAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $address = $this->faker->fullAddress();

            $this->assertMatchesRegularExpression("/^[\p{L}\d' ]+ \d{1,3}, \d{5} [\p{L} ]+ [A-Z]{2}$/u", $address);

            $city = preg_replace('/^.*, \d{5} (.+) [A-Z]{2}$/u', '$1', $address);
            $this->assertSame($this->cities[$city], substr($address, -2), 'The province code should match the city.');
        }
    }
}

<?php

namespace Xefi\Faker\ItIt\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Extensions\PersonExtension;

final class PersonExtensionTest extends TestCase
{
    protected array $firstNameMale = [];
    protected array $firstNameFemale = [];
    protected array $lastName = [];
    protected array $titleMale = [];
    protected array $titleFemale = [];

    protected function setUp(): void
    {
        parent::setUp();

        $personExtension = new \Xefi\Faker\ItIt\Extensions\PersonExtension(new Randomizer());
        $this->firstNameMale = (new ReflectionClass($personExtension))->getProperty('firstNameMale')->getValue($personExtension);
        $this->firstNameFemale = (new ReflectionClass($personExtension))->getProperty('firstNameFemale')->getValue($personExtension);
        $this->lastName = (new ReflectionClass($personExtension))->getProperty('lastName')->getValue($personExtension);
        $this->titleMale = (new ReflectionClass($personExtension))->getProperty('titleMale')->getValue($personExtension);
        $this->titleFemale = (new ReflectionClass($personExtension))->getProperty('titleFemale')->getValue($personExtension);
    }

    public function testFirstNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameFemale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->firstNameFemale,
            $results
        );
    }

    public function testFirstNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameMale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->firstNameMale,
            $results
        );
    }

    public function testFirstName(): void
    {
        $results = [];
        $firstnames = array_unique(array_merge($this->firstNameMale, $this->firstNameFemale));
        for ($i = 0; $i < count($firstnames); $i++) {
            $results[] = $this->faker->unique()->firstName();
        }

        $this->assertEqualsCanonicalizing(
            $firstnames,
            $results
        );
    }

    public function testLastName(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->lastName); $i++) {
            $results[] = $this->faker->unique()->lastName();
        }

        $this->assertEqualsCanonicalizing(
            $this->lastName,
            $results
        );
    }

    public function testNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $this->faker->name(PersonExtension::GENDER_MALE);
        }

        foreach ($results as $result) {
            $matchesFirstName = array_filter($this->firstNameMale, function ($firstName) use ($result) {
                return str_contains($result, $firstName);
            });
            $this->assertNotEmpty($matchesFirstName, "The first part of the result '{$result}' does not match any first name.");

            $matchesLastName = array_filter($this->lastName, function ($lastName) use ($result) {
                return str_contains($result, $lastName);
            });
            $this->assertNotEmpty($matchesLastName, "The second part of the result '{$result}' does not match any last name.");
        }
    }

    public function testNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $this->faker->name(PersonExtension::GENDER_FEMALE);
        }

        foreach ($results as $result) {
            $matchesFirstName = array_filter($this->firstNameFemale, function ($firstName) use ($result) {
                return str_contains($result, $firstName);
            });
            $this->assertNotEmpty($matchesFirstName, "The first part of the result '{$result}' does not match any first name.");

            $matchesLastName = array_filter($this->lastName, function ($lastName) use ($result) {
                return str_contains($result, $lastName);
            });
            $this->assertNotEmpty($matchesLastName, "The second part of the result '{$result}' does not match any last name.");
        }
    }

    public function testName(): void
    {
        $results = [];
        for ($i = 0; $i < 100; $i++) {
            $results[] = $this->faker->name();
        }

        foreach ($results as $result) {
            $matchesFirstName = array_filter(array_merge($this->firstNameFemale, $this->firstNameMale), function ($firstName) use ($result) {
                return str_contains($result, $firstName);
            });
            $this->assertNotEmpty($matchesFirstName, "The first part of the result '{$result}' does not match any first name.");

            $matchesLastName = array_filter($this->lastName, function ($lastName) use ($result) {
                return str_contains($result, $lastName);
            });
            $this->assertNotEmpty($matchesLastName, "The second part of the result '{$result}' does not match any last name.");
        }
    }

    public function testTitleFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleFemale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->titleFemale,
            $results
        );
    }

    public function testTitleMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleMale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->titleMale,
            $results
        );
    }

    public function testTitle(): void
    {
        $titles = array_unique(array_merge($this->titleFemale, $this->titleMale));

        $results = [];
        for ($i = 0; $i < count($titles); $i++) {
            $results[] = $this->faker->unique()->title();
        }

        $this->assertEqualsCanonicalizing(
            $titles,
            $results
        );
    }

    public function testCodiceFiscale(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $codiceFiscale = $this->faker->codiceFiscale();

            $this->assertMatchesRegularExpression('/^[A-Z]{6}\d{2}[ABCDEHLMPRST](0[1-9]|[12]\d|4[1-9]|[56]\d)[A-Z]\d{3}[A-Z]$/', $codiceFiscale);
            $this->assertSame($this->expectedCheckCharacter(substr($codiceFiscale, 0, 15)), $codiceFiscale[15], 'The codice fiscale check character should be valid.');
        }
    }

    public function testCodiceFiscaleGender(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertLessThanOrEqual(31, (int) substr($this->faker->codiceFiscale(PersonExtension::GENDER_MALE), 9, 2));
            $this->assertGreaterThanOrEqual(41, (int) substr($this->faker->codiceFiscale(PersonExtension::GENDER_FEMALE), 9, 2));
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

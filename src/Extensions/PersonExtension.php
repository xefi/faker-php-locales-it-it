<?php

namespace Xefi\Faker\ItIt\Extensions;

use Xefi\Faker\Extensions\PersonExtension as BasePersonExtension;
use Xefi\Faker\ItIt\Calculators\CheckCharacter;

class PersonExtension extends BasePersonExtension
{
    public function getLocale(): ?string
    {
        return 'it_IT';
    }

    protected $firstNameMale = [
        'Francesco', 'Alessandro', 'Lorenzo', 'Leonardo', 'Mattia', 'Andrea', 'Gabriele', 'Riccardo', 'Tommaso', 'Edoardo',
        'Matteo', 'Giuseppe', 'Antonio', 'Giovanni', 'Marco', 'Luca', 'Davide', 'Federico', 'Simone', 'Pietro',
        'Salvatore', 'Vincenzo', 'Roberto', 'Stefano', 'Paolo', 'Massimo', 'Fabio', 'Alberto', 'Giorgio', 'Michele',
        'Carlo', 'Daniele', 'Emanuele', 'Nicola', 'Raffaele', 'Domenico', 'Claudio', 'Enrico', 'Filippo', 'Christian',
    ];

    protected $firstNameFemale = [
        'Sofia', 'Giulia', 'Aurora', 'Alice', 'Ginevra', 'Emma', 'Giorgia', 'Greta', 'Beatrice', 'Anna',
        'Chiara', 'Francesca', 'Maria', 'Sara', 'Martina', 'Elena', 'Valentina', 'Alessia', 'Federica', 'Silvia',
        'Laura', 'Paola', 'Roberta', 'Simona', 'Cristina', 'Daniela', 'Elisa', 'Ilaria', 'Michela', 'Serena',
        'Rosa', 'Teresa', 'Angela', 'Lucia', 'Giovanna', 'Antonella', 'Barbara', 'Camilla', 'Noemi', 'Matilde',
    ];

    protected $lastName = [
        'Rossi', 'Russo', 'Ferrari', 'Esposito', 'Bianchi', 'Romano', 'Colombo', 'Ricci', 'Marino', 'Greco',
        'Bruno', 'Gallo', 'Conti', 'De Luca', 'Mancini', 'Costa', 'Giordano', 'Rizzo', 'Lombardi', 'Moretti',
        'Barbieri', 'Fontana', 'Santoro', 'Mariani', 'Rinaldi', 'Caruso', 'Ferrara', 'Galli', 'Martini', 'Leone',
        'Longo', 'Gentile', 'Martinelli', 'Vitale', 'Lombardo', 'Serra', 'Coppola', 'De Santis', 'D\'Angelo', 'Marchetti',
    ];

    protected $titleMale = ['Sig.', 'Dott.', 'Prof.', 'Avv.', 'Ing.'];

    protected $titleFemale = ['Sig.ra', 'Dott.ssa', 'Prof.ssa', 'Avv.', 'Ing.'];

    protected array $codiceFiscaleMonths = ['A', 'B', 'C', 'D', 'E', 'H', 'L', 'M', 'P', 'R', 'S', 'T'];

    protected array $codiceFiscaleMunicipalities = [
        'H501', 'F205', 'F839', 'L219', 'G273', 'D969', 'A944', 'D612', 'A662', 'C351', 'L736', 'L781',
    ];

    /**
     * Return a codice fiscale with a valid check character, built from a random name and birth date.
     *
     * @param ?string $gender
     *
     * @return string
     */
    public function codiceFiscale(?string $gender = null): string
    {
        if ($gender === null) {
            $gender = $this->randomizer->getInt(0, 1) === 0 ? static::GENDER_FEMALE : static::GENDER_MALE;
        }

        $day = $this->randomizer->getInt(1, 28) + ($gender === static::GENDER_FEMALE ? 40 : 0);

        $code = sprintf(
            '%s%s%02d%s%02d%s',
            $this->codiceFiscaleLastName($this->lastName()),
            $this->codiceFiscaleFirstName($this->firstName($gender)),
            $this->randomizer->getInt(0, 99),
            $this->pickArrayRandomElement($this->codiceFiscaleMonths),
            $day,
            $this->pickArrayRandomElement($this->codiceFiscaleMunicipalities)
        );

        return $code.CheckCharacter::compute($code);
    }

    /**
     * Encode a last name: its consonants, then its vowels, padded with X to three letters.
     *
     * @param string $lastName
     *
     * @return string
     */
    protected function codiceFiscaleLastName(string $lastName): string
    {
        [$consonants, $vowels] = $this->splitLetters($lastName);

        return substr(str_pad($consonants.$vowels, 3, 'X'), 0, 3);
    }

    /**
     * Encode a first name: the first, third and fourth consonants when it has more than three, otherwise like a last name.
     *
     * @param string $firstName
     *
     * @return string
     */
    protected function codiceFiscaleFirstName(string $firstName): string
    {
        [$consonants] = $this->splitLetters($firstName);

        if (strlen($consonants) > 3) {
            return $consonants[0].$consonants[2].$consonants[3];
        }

        return $this->codiceFiscaleLastName($firstName);
    }

    /**
     * Split a name into its uppercase consonants and vowels, ignoring accents, spaces and apostrophes.
     *
     * @param string $name
     *
     * @return array{0: string, 1: string}
     */
    protected function splitLetters(string $name): array
    {
        $letters = preg_replace('/[^A-Z]/', '', strtoupper(strtr($name, ['à' => 'a', 'è' => 'e', 'é' => 'e', 'ì' => 'i', 'ò' => 'o', 'ù' => 'u'])));

        return [
            preg_replace('/[AEIOU]/', '', $letters),
            preg_replace('/[^AEIOU]/', '', $letters),
        ];
    }
}

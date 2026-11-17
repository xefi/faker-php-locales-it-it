<?php

namespace Xefi\Faker\ItIt\Extensions;

use Xefi\Faker\Extensions\Extension;

class AddressExtension extends Extension
{
    public function getLocale(): ?string
    {
        return 'it_IT';
    }

    protected $regions = [
        'Abruzzo', 'Basilicata', 'Calabria', 'Campania', 'Emilia-Romagna', 'Friuli-Venezia Giulia', 'Lazio',
        'Liguria', 'Lombardia', 'Marche', 'Molise', 'Piemonte', 'Puglia', 'Sardegna', 'Sicilia', 'Toscana',
        'Trentino-Alto Adige', 'Umbria', 'Valle d\'Aosta', 'Veneto',
    ];

    protected $provinces = [
        'Roma' => 'RM', 'Milano' => 'MI', 'Napoli' => 'NA', 'Torino' => 'TO', 'Palermo' => 'PA', 'Genova' => 'GE',
        'Bologna' => 'BO', 'Firenze' => 'FI', 'Bari' => 'BA', 'Catania' => 'CT', 'Venezia' => 'VE', 'Verona' => 'VR',
        'Messina' => 'ME', 'Padova' => 'PD', 'Trieste' => 'TS', 'Brescia' => 'BS', 'Parma' => 'PR', 'Taranto' => 'TA',
        'Prato' => 'PO', 'Modena' => 'MO', 'Reggio Calabria' => 'RC', 'Reggio Emilia' => 'RE', 'Perugia' => 'PG',
        'Livorno' => 'LI', 'Ravenna' => 'RA', 'Cagliari' => 'CA', 'Foggia' => 'FG', 'Rimini' => 'RN',
        'Salerno' => 'SA', 'Ferrara' => 'FE', 'Sassari' => 'SS', 'Latina' => 'LT', 'Monza e della Brianza' => 'MB',
        'Pescara' => 'PE', 'Bergamo' => 'BG', 'Vicenza' => 'VI', 'Trento' => 'TN', 'Bolzano' => 'BZ',
        'Ancona' => 'AN', 'Lecce' => 'LE', 'Udine' => 'UD', 'Aosta' => 'AO',
    ];

    protected $cities = [
        'Roma' => 'RM', 'Milano' => 'MI', 'Napoli' => 'NA', 'Torino' => 'TO', 'Palermo' => 'PA', 'Genova' => 'GE',
        'Bologna' => 'BO', 'Firenze' => 'FI', 'Bari' => 'BA', 'Catania' => 'CT', 'Venezia' => 'VE', 'Verona' => 'VR',
        'Messina' => 'ME', 'Padova' => 'PD', 'Trieste' => 'TS', 'Brescia' => 'BS', 'Parma' => 'PR', 'Taranto' => 'TA',
        'Prato' => 'PO', 'Modena' => 'MO', 'Monza' => 'MB', 'Giugliano in Campania' => 'NA', 'Sesto San Giovanni' => 'MI',
        'Torre del Greco' => 'NA', 'Pozzuoli' => 'NA', 'Rho' => 'MI', 'Moncalieri' => 'TO', 'Imola' => 'BO',
        'Empoli' => 'FI', 'Chioggia' => 'VE',
    ];

    protected $streetTypes = ['Via', 'Viale', 'Piazza', 'Corso', 'Largo', 'Vicolo', 'Piazzale', 'Strada', 'Lungomare', 'Contrada'];

    protected $streetNames = [
        'Roma', 'Garibaldi', 'Giuseppe Mazzini', 'Dante Alighieri', 'Cavour', 'Vittorio Emanuele II', 'XX Settembre',
        'Giacomo Matteotti', 'Antonio Gramsci', 'della Repubblica', 'Umberto I', 'Marconi', 'IV Novembre',
        'della Libertà', 'Aldo Moro', 'Alcide De Gasperi', 'San Francesco', 'dei Mille', 'Nazionale', 'Verdi',
        'Leonardo da Vinci', 'Galileo Galilei', 'Trieste', 'Alessandro Manzoni', 'Cristoforo Colombo',
        'Santa Maria', 'del Popolo', 'della Vittoria', 'Indipendenza', 'Carducci',
    ];

    /**
     * Return a random region.
     *
     * @return string
     */
    public function region(): string
    {
        return $this->pickArrayRandomElement($this->regions);
    }

    /**
     * Return a random province name.
     *
     * @return string
     */
    public function province(): string
    {
        return $this->pickArrayRandomKey($this->provinces);
    }

    /**
     * Return a random two-letter province code (sigla).
     *
     * @return string
     */
    public function provinceCode(): string
    {
        return $this->pickArrayRandomElement($this->provinces);
    }

    /**
     * Return a random city name.
     *
     * @return string
     */
    public function city(): string
    {
        return $this->pickArrayRandomKey($this->cities);
    }

    /**
     * Return a random five-digit CAP.
     *
     * @return string
     */
    public function postcode(): string
    {
        return sprintf('%05d', $this->randomizer->getInt(10, 98168));
    }

    /**
     * Return a random house number.
     *
     * @return int
     */
    public function houseNumber(): int
    {
        return $this->randomizer->getInt(1, 250);
    }

    /**
     * Return a random street name, such as "Via Garibaldi".
     *
     * @return string
     */
    public function streetName(): string
    {
        return sprintf('%s %s', $this->pickArrayRandomElement($this->streetTypes), $this->pickArrayRandomElement($this->streetNames));
    }

    /**
     * Return a random street name followed by a house number.
     *
     * @return string
     */
    public function streetAddress(): string
    {
        return sprintf('%s %d', $this->streetName(), $this->houseNumber());
    }

    /**
     * Return a full postal address, such as "Via Garibaldi 12, 20121 Milano MI".
     *
     * @return string
     */
    public function fullAddress(): string
    {
        $city = $this->pickArrayRandomKey($this->cities);

        return sprintf('%s, %s %s %s', $this->streetAddress(), $this->postcode(), $city, $this->cities[$city]);
    }
}

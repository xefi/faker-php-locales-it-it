<?php

namespace Xefi\Faker\ItIt\Extensions;

use Xefi\Faker\Calculators\Luhn;
use Xefi\Faker\Extensions\Extension;

class CompanyExtension extends Extension
{
    public function getLocale(): ?string
    {
        return 'it_IT';
    }

    private array $companies = [
        'Rossi & Figli S.r.l.', 'Costruzioni Bianchi S.p.A.', 'Officine Meccaniche Lombarde S.p.A.',
        'Tessitura Ferrari S.r.l.', 'Esposito Trasporti S.n.c.', 'Romano Alimentari S.r.l.',
        'Colombo Arredamenti S.a.s.', 'Ricci Impianti S.r.l.', 'Marino Consulting S.r.l.s.',
        'Greco Edilizia S.r.l.', 'Bruno & Associati S.t.p.', 'Gallo Informatica S.r.l.',
        'Conti Logistica S.p.A.', 'De Luca Ceramiche S.r.l.', 'Mancini Vini S.a.s.',
        'Costa Nautica S.r.l.', 'Giordano Pelletterie S.n.c.', 'Rizzo Energia S.p.A.',
        'Lombardi Farmaceutici S.p.A.', 'Moretti Design S.r.l.', 'Barbieri Assicurazioni S.p.A.',
        'Fontana Acciai S.r.l.', 'Santoro Olio S.a.s.', 'Mariani Ingegneria S.r.l.',
        'Rinaldi Tessuti S.r.l.', 'Caruso Dolciaria S.n.c.', 'Ferrara Telecomunicazioni S.p.A.',
        'Galli Elettronica S.r.l.', 'Martini Immobiliare S.r.l.', 'Leone Agricola S.s.',
    ];

    /**
     * Return a random company name.
     *
     * @return string
     */
    public function company(): string
    {
        return $this->pickArrayRandomElement($this->companies);
    }

    /**
     * Return an 11-digit partita IVA: 7-digit company number, 3-digit tax office code and a Luhn check digit.
     *
     * @return string
     */
    public function partitaIva(): string
    {
        $number = $this->randomizer->getBytesFromString('0123456789', 7);
        $office = sprintf('%03d', $this->randomizer->getInt(1, 100));

        return $number.$office.Luhn::checksum((int) ($number.$office));
    }

    /**
     * Return an Italian intra-community VAT number, such as "IT12345678903".
     *
     * @return string
     */
    public function vat(): string
    {
        return 'IT'.$this->partitaIva();
    }
}

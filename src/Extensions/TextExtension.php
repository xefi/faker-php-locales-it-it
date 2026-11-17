<?php

namespace Xefi\Faker\ItIt\Extensions;

use Xefi\Faker\Extensions\TextExtension as BaseTextExtension;

class TextExtension extends BaseTextExtension
{
    public function getLocale(): ?string
    {
        return 'it_IT';
    }

    /**
     * Text in format => Paragraphs => Sentences => Words.
     *
     * @var array|array[]
     */
    protected array $paragraphs = [
        [
            ['La', 'qualità', 'del', 'servizio', 'resta', 'un', 'obiettivo', 'centrale', 'per', 'ogni', 'azienda.'],
            ['Ogni', 'progetto', 'richiede', 'attenzione', 'e', 'una', 'pianificazione', 'accurata.'],
            ['I', 'collaboratori', 'lavorano', 'insieme', 'per', 'raggiungere', 'traguardi', 'comuni.'],
            ['Una', 'comunicazione', 'chiara', 'favorisce', 'la', 'produttività', 'e', 'la', 'fiducia', 'reciproca.'],
        ],
        [
            ['La', 'gestione', 'delle', 'risorse', 'è', 'un', 'elemento', 'chiave', 'del', 'successo.'],
            ['I', 'metodi', 'di', 'lavoro', 'cambiano', 'secondo', 'le', 'esigenze', 'e', 'le', 'tecnologie', 'disponibili.'],
            ['La', 'flessibilità', 'permette', 'alle', 'imprese', 'di', 'restare', 'competitive', 'e', 'innovative.'],
            ['I', 'processi', 'vengono', 'rivisti', 'per', 'migliorare', 'i', 'risultati', 'e', 'rispondere', 'al', 'mercato.'],
        ],
        [
            ['La', 'soddisfazione', 'dei', 'clienti', 'dipende', 'dalla', 'cura', 'dei', 'dettagli.'],
            ['Alcuni', 'indicatori', 'aiutano', 'a', 'misurare', 'le', 'prestazioni', 'e', 'a', 'orientare', 'le', 'scelte.'],
            ['Le', 'difficoltà', 'quotidiane', 'si', 'superano', 'grazie', 'al', 'lavoro', 'di', 'squadra.'],
            ['Una', 'valutazione', 'periodica', 'delle', 'pratiche', 'mette', 'in', 'luce', 'possibili', 'miglioramenti.'],
        ],
        [
            ['La', 'formazione', 'continua', 'è', 'una', 'priorità', 'per', 'molte', 'organizzazioni.'],
            ['I', 'dipendenti', 'sono', 'incoraggiati', 'a', 'sviluppare', 'nuove', 'competenze.'],
            ['Le', 'strategie', 'di', 'miglioramento', 'riducono', 'i', 'rischi', 'e', 'aumentano', 'l\'efficienza.'],
            ['Programmi', 'su', 'misura', 'sostengono', 'la', 'crescita', 'individuale', 'e', 'collettiva.'],
        ],
        [
            ['L\'analisi', 'dei', 'dati', 'aiuta', 'a', 'individuare', 'nuove', 'opportunità', 'di', 'crescita.'],
            ['Gli', 'obiettivi', 'si', 'adattano', 'all\'evoluzione', 'del', 'mercato', 'e', 'alle', 'attese', 'dei', 'clienti.'],
            ['Un', 'controllo', 'regolare', 'dei', 'progressi', 'permette', 'di', 'reagire', 'rapidamente', 'ai', 'cambiamenti.'],
            ['Le', 'decisioni', 'si', 'basano', 'su', 'dati', 'affidabili', 'e', 'analisi', 'precise.'],
            ['Le', 'revisioni', 'periodiche', 'consentono', 'di', 'correggere', 'la', 'rotta', 'quando', 'serve.'],
        ],
    ];
}

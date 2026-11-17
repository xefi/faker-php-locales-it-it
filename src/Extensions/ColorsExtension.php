<?php

namespace Xefi\Faker\ItIt\Extensions;

use Xefi\Faker\Extensions\ColorsExtension as BaseColorsExtension;

class ColorsExtension extends BaseColorsExtension
{
    public function getLocale(): ?string
    {
        return 'it_IT';
    }

    protected array $safeColorNames = [
        'Nero', 'Marrone', 'Verde', 'BluMarino', 'Oliva',
        'Porpora', 'VerdeAcqua', 'Lime', 'Blu', 'Argento',
        'Grigio', 'Giallo', 'Fucsia', 'Acqua', 'Bianco',
    ];

    protected array $colorNames = [
        'Nero', 'Marrone', 'Verde', 'BluMarino', 'Oliva',
        'Porpora', 'VerdeAcqua', 'Lime', 'Blu', 'Argento',
        'Grigio', 'Giallo', 'Fucsia', 'Acqua', 'Bianco',
        'Beige', 'Cioccolato', 'Corallo', 'Ciano', 'Cremisi',
        'BluScuro', 'ArancioneScuro', 'Mattone', 'VerdeMare', 'BiancoFloreale',
        'VerdeForesta', 'Oro', 'Rosa', 'Indaco', 'Cachi',
        'Lavanda', 'Azzurro', 'CoralloChiaro', 'VerdeChiaro', 'SalmoneChiaro',
        'Lino', 'Magenta', 'BluMedio', 'OrchideaMedia', 'Mocassino',
        'Arancione', 'Rosso', 'Prugna', 'Perù', 'BluReale',
        'Salmone', 'MarroneSabbia', 'Celeste', 'Neve', 'Turchese',
        'Viola', 'BiancoFumo',
    ];
}

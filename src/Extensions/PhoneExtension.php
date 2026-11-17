<?php

namespace Xefi\Faker\ItIt\Extensions;

use Xefi\Faker\Extensions\PhoneExtension as BasePhoneExtension;

class PhoneExtension extends BasePhoneExtension
{
    public string $indicator = '+39';

    public function getLocale(): ?string
    {
        return 'it_IT';
    }

    protected array $landlineFormats = [
        '06{separator}{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '02{separator}{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '011{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '010{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '041{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '051{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '055{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '081{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '091{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
    ];

    protected array $cellFormats = [
        '32{d}{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '33{d}{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '34{d}{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '36{d}{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '38{d}{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '39{d}{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
    ];
}

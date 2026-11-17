<?php

namespace Xefi\Faker\ItIt;

use Xefi\Faker\ItIt\Extensions\AddressExtension;
use Xefi\Faker\ItIt\Extensions\ColorsExtension;
use Xefi\Faker\ItIt\Extensions\CompanyExtension;
use Xefi\Faker\ItIt\Extensions\FinancialExtension;
use Xefi\Faker\ItIt\Extensions\PersonExtension;
use Xefi\Faker\ItIt\Extensions\PhoneExtension;
use Xefi\Faker\ItIt\Extensions\TextExtension;
use Xefi\Faker\Providers\Provider;

class FakerItItServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->extensions([
            AddressExtension::class,
            ColorsExtension::class,
            CompanyExtension::class,
            FinancialExtension::class,
            PersonExtension::class,
            PhoneExtension::class,
            TextExtension::class,
        ]);
    }
}

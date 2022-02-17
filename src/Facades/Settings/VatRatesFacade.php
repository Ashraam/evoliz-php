<?php

namespace Ashraam\Evoliz\Facades\Settings;

use Ashraam\Evoliz\Settings\VatRates;
use Illuminate\Support\Facades\Facade;

class VatRatesFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return VatRates::class;
    }
}

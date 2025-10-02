<?php

namespace Ashraam\Evoliz\Settings;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class VatRates implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of vat rates visible by the current user.
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to("vat-rates")->withQuery($query)->get();
    }

    /**
     * Return a unit code by its specified Id
     *
     * @param Int $vatRateId
     */
    public function get(Int $vatRateId)
    {
        return $this->builder->to("vat-rates/{$vatRateId}")->get();
    }
}

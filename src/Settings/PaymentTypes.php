<?php

namespace Ashraam\Evoliz\Settings;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class PaymentTypes implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of payment types
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to("paytypes")->withQuery($query)->get();
    }

    /**
     * Return a payment type by its specified id
     *
     * @param Int $payTypeId
     */
    public function get(Int $payTypeId)
    {
        return $this->builder->to("paytypes/{$payTypeId}")->get();
    }
}

<?php

namespace Ashraam\Evoliz\Settings;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class PaymentTerms implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of payment terms
     *
     * @param array $query
     * @return void
     */
    public function list(array $query = [])
    {
        return $this->builder->to("payterms")->withQuery($query)->get();
    }

    /**
     * Return a payment term by its specified id
     *
     * @param Int $payTermId
     * @return void
     */
    public function get(Int $payTermId)
    {
        return $this->builder->to("payterms/{$payTermId}")->get();
    }
}

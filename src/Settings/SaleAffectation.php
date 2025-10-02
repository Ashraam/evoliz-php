<?php

namespace Ashraam\Evoliz\Settings;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class SaleAffectation implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of sales affectations
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to("sale-affectations")->withQuery($query)->get();
    }

    /**
     * Return a sale affectation by its specified Id
     *
     * @param Int $affectationId
     */
    public function get(Int $affectationId)
    {
        return $this->builder->to("sale-affectations/{$affectationId}")->get();
    }
}

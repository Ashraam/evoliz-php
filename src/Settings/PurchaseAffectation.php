<?php

namespace Ashraam\Evoliz\Settings;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class PurchaseAffectation implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of Purchases affectations
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to("purchase-affectations")->withQuery($query)->get();
    }

    /**
     * Return a purchase affectation by its specified Id
     *
     * @param Int $affectationId
     */
    public function get(Int $affectationId)
    {
        return $this->builder->to("purchase-affectations/{$affectationId}")->get();
    }
}

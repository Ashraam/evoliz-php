<?php

namespace Ashraam\Evoliz\Settings;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class UnitCodes implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of units codes, used in various endpoints
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to("unit-codes")->withQuery($query)->get();
    }

    /**
     * Return a unit code by its specified Id
     *
     * @param Int $unitCodeId
     */
    public function get(Int $unitCodeId)
    {
        return $this->builder->to("unit-codes/{$unitCodeId}")->get();
    }
}

<?php

namespace Ashraam\Evoliz\Settings;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class SaleClassification implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of sales classifications
     *
     * @param array $query
     * @return void
     */
    public function list(array $query = [])
    {
        return $this->builder->to("sale-classifications")->withQuery($query)->get();
    }

    /**
     * Return a sale classification by its specified Id
     *
     * @param Int $classificationId
     * @return void
     */
    public function get(Int $classificationId)
    {
        return $this->builder->to("sale-classifications/{$classificationId}")->get();
    }
}

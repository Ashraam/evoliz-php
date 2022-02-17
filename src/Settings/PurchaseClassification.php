<?php

namespace Ashraam\Evoliz\Settings;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class PurchaseClassification implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of Purchases classifications
     *
     * @param array $query
     * @return void
     */
    public function list(array $query = [])
    {
        return $this->builder->to("purchase-classifications")->withQuery($query)->get();
    }

    /**
     * Return a purchase classification by its specified Id
     *
     * @param Int $classificationId
     * @return void
     */
    public function get(Int $classificationId)
    {
        return $this->builder->to("purchase-classifications/{$classificationId}")->get();
    }
}

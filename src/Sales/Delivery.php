<?php

namespace Ashraam\Evoliz\Sales;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class Delivery implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of deliveries visible by the current User, according to visibility restriction set in user profile
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to("deliveries")->withQuery($query)->get();
    }

    /**
     * Return a delivery by its speficied id
     *
     * @param Int $deliveryId
     */
    public function get(Int $deliveryId)
    {
        return $this->builder->to("deliveries/{$deliveryId}")->get();
    }
}

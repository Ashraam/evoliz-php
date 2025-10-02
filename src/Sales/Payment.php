<?php

namespace Ashraam\Evoliz\Sales;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class Payment implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of payments visible by the current User, according to visibility restriction set in user profile
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to("payments")->withQuery($query)->get();
    }

    /**
     * Return a payment by its speficied id
     *
     * @param Int $paymentId
     */
    public function get(Int $paymentId)
    {
        return $this->builder->to("payments/{$paymentId}")->get();
    }
}

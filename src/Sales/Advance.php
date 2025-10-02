<?php

namespace Ashraam\Evoliz\Sales;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class Advance implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of advances visible by the current User, according to visibility restriction set in user profile
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to("advances")->withQuery($query)->get();
    }

    /**
     * List all payments of the given advance
     *
     * @param Int $advanceId
     * @param array $query
     */
    public function payments(Int $advanceId, array $query = [])
    {
        return $this->builder->to("advances/{$advanceId}/payments")->withQuery($query)->get();
    }

    /**
     * Create a new payment with given data
     *
     * @param Int $advanceId
     * @param array $body
     */
    public function payment(Int $advanceId, array $body = [])
    {
        return $this->builder->to("advances/{$advanceId}/payments")->withBody($body)->post();
    }

    /**
     * Return an advance by its speficied id
     *
     * @param Int $advanceId
     */
    public function get(Int $advanceId)
    {
        return $this->builder->to("advances/{$advanceId}")->get();
    }
}

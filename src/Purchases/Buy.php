<?php

namespace Ashraam\Evoliz\Purchases;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\RequestBuilder;
use Ashraam\Evoliz\EvolizInterface;

class Buy implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of buys visible by the current User, according to visibility restriction set in user profile
     *
     * @param array $query
     * @return void
     */
    public function list(array $query = [])
    {
        return $this->builder->to("buys")->withQuery($query)->get();
    }

    /**
     * Return a buy by its speficied id
     *
     * @param Int $buyId
     * @return void
     */
    public function get(Int $buyId)
    {
        return $this->builder->to("buys/{$buyId}")->get();
    }

    /**
     * Update buy state to locked
     *
     * @param Int $buyId
     * @return void
     */
    public function lock(Int $buyId)
    {
        return $this->builder->to("buys/{$buyId}")->withBody([
            'lock' => true
        ])->put();
    }

    /**
     * Update buy state to unlocked
     *
     * @param Int $buyId
     * @return void
     */
    public function unlock(Int $buyId)
    {
        return $this->builder->to("buys/{$buyId}")->withBody([
            'lock' => false
        ])->put();
    }
}

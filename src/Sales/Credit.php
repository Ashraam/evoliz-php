<?php

namespace Ashraam\Evoliz\Sales;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class Credit implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of credits visible by the current User, according to visibility restriction set in user profile
     *
     * @param array $query
     * @return void
     */
    public function list(array $query = [])
    {
        return $this->builder->to("credits")->withQuery($query)->get();
    }

    /**
     * Return a credit by its speficied id
     *
     * @param Int $creditId
     * @return void
     */
    public function get(Int $creditId)
    {
        return $this->builder->to("credits/{$creditId}")->get();
    }
}

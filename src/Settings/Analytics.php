<?php

namespace Ashraam\Evoliz\Settings;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class Analytics implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of analytics axis
     *
     * @param array $query
     * @return void
     */
    public function list(array $query = [])
    {
        return $this->builder->to("analytics")->withQuery($query)->get();
    }

    /**
     * Return an analytic axis by its specified Id
     *
     * @param Int $analyticId
     * @return void
     */
    public function get(Int $analyticId)
    {
        return $this->builder->to("analytics/{$analyticId}")->get();
    }
}

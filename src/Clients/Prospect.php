<?php

namespace Ashraam\Evoliz\Clients;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\RequestBuilder;
use Ashraam\Evoliz\EvolizInterface;

class Prospect implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return the prospect list of the specified or current user company
     *
     * @param array $query
     * @return void
     */
    public function list(array $query = [])
    {
        return $this->builder->to("prospects")->withQuery($query)->get();
    }


    /**
     * Return a prospect by it's id
     *
     * @param Int $prospectId
     * @return void
     */
    public function get(Int $prospectId)
    {
        return $this->builder->to("prospects/{$prospectId}")->get();
    }
}

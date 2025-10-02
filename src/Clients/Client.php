<?php

namespace Ashraam\Evoliz\Clients;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class Client implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return the client list of the specified or current user company
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to("clients")->withQuery($query)->get();
    }

    /**
     * Create a new client with given data
     *
     * @param array $body
     */
    public function create(array $body = [])
    {
        return $this->builder->to("clients")->withBody($body)->post();
    }

    /**
     * Return a client by its speficied id
     *
     * @param Int $clientId
     */
    public function get(Int $clientId)
    {
        return $this->builder->to("clients/{$clientId}")->get();
    }
}

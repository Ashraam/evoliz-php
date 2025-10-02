<?php

namespace Ashraam\Evoliz\Clients;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\RequestBuilder;
use Ashraam\Evoliz\EvolizInterface;

class ContactClient implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a client contact list
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to("contacts-clients")->withQuery($query)->get();
    }

    /**
     * Create a new client contact with given data
     *
     * @param array $body
     */
    public function create(array $body = [])
    {
        return $this->builder->to("contacts-clients")->withBody($body)->post();
    }

    /**
     * Return a client contact by it's id
     *
     * @param Int $contactId
     */
    public function get(Int $contactId)
    {
        return $this->builder->to("contacts-clients/{$contactId}")->get();
    }
}

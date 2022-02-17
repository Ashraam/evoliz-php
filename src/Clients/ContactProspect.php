<?php

namespace Ashraam\Evoliz\Clients;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\RequestBuilder;
use Ashraam\Evoliz\EvolizInterface;

class ContactProspect implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a prospect contact list
     *
     * @param array $query
     * @return void
     */
    public function list(array $query = [])
    {
        return $this->builder->to("contacts-prospects")->withQuery($query)->get();
    }

    /**
     * Return a prospect contact by it's id
     *
     * @param Int $contactId
     * @return void
     */
    public function get(Int $contactId)
    {
        return $this->builder->to("contacts-prospects/{$contactId}")->get();
    }
}

<?php

namespace Ashraam\Evoliz\Banks;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class BankAccount implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of banks visible by the current user, according to visibility restriction set in user profile
     *
     * @param array $query
     * @return void
     */
    public function list(array $query = [])
    {
        return $this->builder->to("banks")->withQuery($query)->get();
    }

    /**
     * Return a bank details by its specific id, according to visibility restriction set in user profile
     *
     * @param Int $bankId
     * @return void
     */
    public function get(Int $bankId)
    {
        return $this->builder->to("banks/{$bankId}")->get();
    }
}

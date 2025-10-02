<?php

namespace Ashraam\Evoliz\Administration;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class User implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of users visible by the current User, according to visibility restriction set in user profile.
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to("users")->withQuery($query)->get();
    }

    /**
     * Get the detail of a user by it's id
     *
     * @param Int $userId
     */
    public function get(Int $userId)
    {
        return $this->builder->to("users/{$userId}")->get();
    }
}

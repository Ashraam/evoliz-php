<?php

namespace Ashraam\Evoliz\Settings;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class Accounts implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of accounting classification visible by the current user.
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to("accounts")->withQuery($query)->get();
    }

    /**
     * Create a new accounting classification with given data
     *
     * @param array $body
     */
    public function create(array $body = [])
    {
        return $this->builder->to("accounts")->withBody($body)->post();
    }

    /**
     * Return an accounting account by its specified Id.
     *
     * @param Int $accountId
     */
    public function get(Int $accountId)
    {
        return $this->builder->to("accounts/{$accountId}")->get();
    }
}

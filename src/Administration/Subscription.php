<?php

namespace Ashraam\Evoliz\Administration;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class Subscription implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return the list of the company's subscriptions.
     *
     * @return void
     */
    public function list()
    {
        return $this->builder->to("subscriptions")->get();
    }
}

<?php

namespace Ashraam\Evoliz\Sales;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class Quote implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of quotes visible by the current User, according to visibility restriction set in user profile
     *
     * @param array $query
     * @return void
     */
    public function list(array $query = [])
    {
        return $this->builder->to("quotes")->withQuery($query)->get();
    }

    /**
     * Return a quote by its speficied id
     *
     * @param Int $quoteId
     * @return void
     */
    public function get(Int $quoteId)
    {
        return $this->builder->to("quotes/{$quoteId}")->get();
    }
}

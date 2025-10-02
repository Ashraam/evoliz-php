<?php

namespace Ashraam\Evoliz\Journals;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\RequestBuilder;
use Ashraam\Evoliz\EvolizInterface;

class Journals implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Get trial balance data
     *
     * @param array $query
     */
    public function trial_balance(array $query = [])
    {
        return $this->builder->to("journals/trial-balance")->withQuery($query)->get();
    }

    /**
     * Get general ledger data
     *
     * @param array $query
     */
    public function general_ledger(array $query = [])
    {
        return $this->builder->to("journals/general-ledger")->withQuery($query)->get();
    }

    /**
     * Get FEC journal entries
     *
     * @param array $query
     */
    public function fec(array $query = [])
    {
        return $this->builder->to("journals/fec")->withQuery($query)->get();
    }

    /**
     * Get banks journal entries
     *
     * @param array $query
     */
    public function banks(array $query = [])
    {
        return $this->builder->to("journals/banks")->withQuery($query)->get();
    }

    /**
     * Get Cashes journal entries
     *
     * @param array $query
     */
    public function cash(array $query = [])
    {
        return $this->builder->to("journals/cashes")->withQuery($query)->get();
    }

    /**
     * Get sales journal entries
     *
     * @param array $query
     */
    public function sales(array $query = [])
    {
        return $this->builder->to("journals/sales")->withQuery($query)->get();
    }

    /**
     * Get purchases journal data
     *
     * @param array $query
     */
    public function purchases(array $query = [])
    {
        return $this->builder->to("journals/purchases")->withQuery($query)->get();
    }

    /**
     * Get miscellaneous operations journal entries
     *
     * @param array $query
     */
    public function miscellaneous(array $query = [])
    {
        return $this->builder->to("journals/miscellaneous-operations")->withQuery($query)->get();
    }

    /**
     * Get opening balance journal entries
     *
     * @param array $query
     */
    public function opening_balance(array $query = [])
    {
        return $this->builder->to("journals/opening-balance")->withQuery($query)->get();
    }
}

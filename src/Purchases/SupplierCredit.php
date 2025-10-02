<?php

namespace Ashraam\Evoliz\Purchases;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\RequestBuilder;
use Ashraam\Evoliz\EvolizInterface;

class SupplierCredit implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of Supplier credits visible by the current User, according to visibility restriction set in user profile
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to("supplier-credits")->withQuery($query)->get();
    }

    /**
     * Return a supplier credit by its speficied id
     *
     * @param Int $supplierCreditId
     */
    public function get(Int $supplierCreditId)
    {
        return $this->builder->to("supplier-credits/{$supplierCreditId}")->get();
    }

    /**
     * Update supplier credit state to locked
     *
     * @param Int $supplierCreditId
     */
    public function lock(Int $supplierCreditId)
    {
        return $this->builder->to("supplier-credits/{$supplierCreditId}")->withBody([
            'lock' => true
        ])->put();
    }

    /**
     * Update supplier credit state to unlocked
     *
     * @param Int $supplierCreditId
     */
    public function unlock(Int $supplierCreditId)
    {
        return $this->builder->to("supplier-credits/{$supplierCreditId}")->withBody([
            'lock' => false
        ])->put();
    }
}

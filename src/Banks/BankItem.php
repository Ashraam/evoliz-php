<?php

namespace Ashraam\Evoliz\Banks;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class BankItem implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of bank items visible by the current User, according to visibility restriction set in user profile
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to("bank-items")->withQuery($query)->get();
    }

    /**
     * Return a bank item by its speficied id
     *
     * @param Int $bankItemId
     */
    public function get(Int $bankItemId)
    {
        return $this->builder->to("bank-items/{$bankItemId}")->get();
    }

    /**
     * Lock a bank item
     *
     * @param Int $bankItemId
     */
    public function lock(Int $bankItemId)
    {
        return $this->builder->to("bank-items/{$bankItemId}/locked")->withBody([
            'locked' => true
        ])->put();
    }

    /**
     * Unlock a bank item
     *
     * @param Int $bankItemId
     */
    public function unlock(Int $bankItemId)
    {
        return $this->builder->to("bank-items/{$bankItemId}/locked")->withBody([
            'locked' => false
        ])->put();
    }
}

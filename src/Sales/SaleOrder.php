<?php

namespace Ashraam\Evoliz\Sales;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class SaleOrder implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of sale orders visible by the current User, according to visibility restriction set in user profile
     *
     * @param array $query
     * @return void
     */
    public function list(array $query = [])
    {
        return $this->builder->to("sale-orders")->withQuery($query)->get();
    }

    /**
     * Create a new sale order with given data. Totals, margins, included VAT fields are automatically calculated.
     *
     * @param array $body
     * @return void
     */
    public function create(array $body = [])
    {
        return $this->builder->to("sale-orders")->withBody($body)->post();
    }

    /**
     * Return a sale order by its speficied id
     *
     * @param Int $orderId
     * @return void
     */
    public function get(Int $orderId)
    {
        return $this->builder->to("sale-orders/{$orderId}")->get();
    }

    /**
     * Create a new invoice from the given sale order.
     *
     * @param Int $orderId
     * @return void
     */
    public function invoice(Int $orderId)
    {
        return $this->builder->to("sale-orders/{$orderId}/invoice")->post();
    }
}

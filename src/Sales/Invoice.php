<?php

namespace Ashraam\Evoliz\Sales;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class Invoice implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of invoices visible by the current User, according to visibility restriction set in user profile
     *
     * @param array $query
     */
    public function list(array $query = [])
    {
        return $this->builder->to('invoices')->withQuery($query)->get();
    }

    /**
     * Create a new draft invoice with given data. Totals, margins, retention, included VAT fields are automatically calculated.
     *
     * @param array $body
     */
    public function create(array $body = [])
    {
        return $this->builder->to('invoices')->withBody($body)->post();
    }

    /**
     * Save the invoice with a definitive document number. The status must be “filled” and will be changed to “created”
     *
     * @param Int $invoiceId
     */
    public function save(Int $invoiceId)
    {
        return $this->builder->to("invoices/{$invoiceId}/create")->post();
    }

    /**
     * Return an invoice by its speficied id
     *
     * @param Int $invoiceId
     */
    public function get(Int $invoiceId)
    {
        return $this->builder->to("invoices/{$invoiceId}")->get();
    }

    /**
     * Send an email with a link to the invoice
     *
     * @param Int $invoiceId
     * @param array $body
     */
    public function send(Int $invoiceId, array $body = [])
    {
        return $this->builder->to("invoices/{$invoiceId}/send")->withBody($body)->post();
    }

    /**
     * Create a new payement with given data
     *
     * @param Int $invoiceId
     * @param array $body
     */
    public function payment(Int $invoiceId, $body = [])
    {
        return $this->builder->to("invoices/{$invoiceId}/payments")->withBody($body)->post();
    }

    /**
     * List all payments of the given invoice
     *
     * @param Int $invoiceId
     * @param array $query
     */
    public function payments(Int $invoiceId, array $query = [])
    {
        return $this->builder->to("invoices/{$invoiceId}/payments")->withQuery($query)->get();
    }
}

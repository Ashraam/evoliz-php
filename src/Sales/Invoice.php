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
     * Create a draft partial credit note from the given invoice. Item amounts must be sent as positive
     * values ; the API automatically converts them to negative amounts and inherits the invoice pricing mode.
     *
     * @param Int $invoiceId
     * @param array $body
     */
    public function partialCredit(Int $invoiceId, array $body = [])
    {
        return $this->builder->to("invoices/{$invoiceId}/partial-credit")->withBody($body)->post();
    }

    /**
     * Create a finalized total credit note from the given invoice, with inverted amounts and bonuses copied
     * from the invoice. If the credit amount equals the invoice amount, the invoice is marked as deleted.
     * Cannot be used if the invoice has payments. An optional "documentdate" (today to +30 days) may be provided.
     *
     * @param Int $invoiceId
     * @param array $body
     */
    public function credit(Int $invoiceId, array $body = [])
    {
        return $this->builder->to("invoices/{$invoiceId}/credit")->withBody($body)->post();
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

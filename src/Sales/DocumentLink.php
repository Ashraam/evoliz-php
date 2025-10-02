<?php

namespace Ashraam\Evoliz\Sales;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class DocumentLink implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of documents links associated to the requested document
     *
     * @param String $documentType
     * @param Int $documentId
     */
    public function get(String $documentType, Int $documentId)
    {
        return $this->builder->to("links/{$documentType}/{$documentId}")->get();
    }
}

<?php

namespace Ashraam\Evoliz\Files;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class File implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return file content encoded in base64
     *
     * @param String $documentType
     * @param Int $documentId
     * @return void
     */
    public function get(String $documentType, Int $documentId)
    {
        return $this->builder->to("files/{$documentType}/{$documentId}")->get();
    }
}

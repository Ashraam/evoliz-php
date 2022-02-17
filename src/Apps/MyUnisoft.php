<?php

namespace Ashraam\Evoliz\Apps;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class MyUnisoft implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Connect MyUnisoft application in company with api key
     *
     * @param string $api_key
     * @return void
     */
    public function connect(string $api_key)
    {
        return $this->builder->to("myunisoft/connect")->withBody([
            'api_key' => $api_key
        ])->post();
    }
}

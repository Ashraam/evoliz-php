<?php

namespace Ashraam\Evoliz\Reports;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\RequestBuilder;
use Ashraam\Evoliz\EvolizInterface;

class Reports implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Get amount of overdue payments by period categories
     *
     * @param array $query
     * @return void
     */
    public function payments(array $query = [])
    {
        return $this->builder->to("reports/overdue-payment")->withQuery($query)->get();
    }

    /**
     * Return a buy by its speficied id
     *
     * @param array $query
     * @return void
     */
    public function settlements(array $query = [])
    {
        return $this->builder->to("reports/overdue-settlement")->withQuery($query)->get();
    }

    /**
     * Get turnover report data
     *
     * @param array $query
     * @return void
     */
    public function turnover(array $query = [])
    {
        return $this->builder->to("reports/turnover")->withQuery($query)->get();
    }
}

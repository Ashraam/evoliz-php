<?php

namespace Ashraam\Evoliz\Catalog;

use Ashraam\Evoliz\Evoliz;
use Ashraam\Evoliz\EvolizInterface;
use Ashraam\Evoliz\RequestBuilder;

class Article implements EvolizInterface
{
    private $builder;

    public function __construct(Evoliz $evoliz)
    {
        $this->builder = new RequestBuilder($evoliz->client);
    }

    /**
     * Return a list of articles
     *
     * @param array $query
     * @return void
     */
    public function list(array $query = [])
    {
        return $this->builder->to("articles")->withQuery($query)->get();
    }

    /**
     * Create a new article with given data
     *
     * @param array $body
     * @return void
     */
    public function create(array $body = [])
    {
        return $this->builder->to("articles")->withBody($body)->post();
    }

    /**
     * Get the detail of an article by it's id
     *
     * @param Int $articleId
     * @return void
     */
    public function get(Int $articleId)
    {
        return $this->builder->to("articles/{$articleId}")->get();
    }
}

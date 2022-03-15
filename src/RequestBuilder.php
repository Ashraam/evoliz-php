<?php

namespace Ashraam\Evoliz;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;

class RequestBuilder
{
    protected $client;

    protected $endpoint;

    protected $resource;

    protected $data = [];

    protected $query = [];

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function to(string $endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    public function withQuery(array $query = [])
    {
        $this->query = $query;

        return $this;
    }

    public function withParams(array $data = [])
    {
        $this->resource = 'form_params';

        $this->data = $data;

        return $this;
    }

    public function withBody(array $data = [])
    {
        return $this->withJson($data);
    }

    public function withJson(array $data = [])
    {
        $this->resource = 'json';

        $this->data = $data;

        return $this;
    }

    public function get()
    {
        return $this->request('get');
    }

    public function post()
    {
        return $this->request('post');
    }

    public function put()
    {
        return $this->request('put');
    }

    public function patch()
    {
        return $this->request('patch');
    }

    public function request($method)
    {
        $options = [];

        if ($this->query) {
            $options['query'] = $this->query;
        }

        if ($this->resource) {
            $options[$this->resource] = $this->data;
        }

        try {
            $response = $this->client->request($method, $this->endpoint, $options);
        } catch (ClientException $ex) {
            $response = $ex->getResponse();
        }

        $this->endpoint = null;
        $this->resource = null;
        $this->data = [];
        $this->query = [];

        return json_decode($response->getBody()->getContents(), true);
    }
}

<?php

namespace Ashraam\Evoliz;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

final class Evoliz
{
    const RETRIES_MAX = 1;

    const ENDPOINT = 'https://www.evoliz.io/api/v1';

    protected $token;

    public ClientInterface $client;

    protected $endpoint;

    protected $company;

    protected $key;

    protected $secret;

    public function __construct(?Int $company, ?String $key, ?String $secret, ?String $endpoint = null)
    {
        $this->company = $company;

        $this->key = $key;

        $this->secret = $secret;

        $this->endpoint = rtrim($endpoint ?? self::ENDPOINT, '/');

        $this->client = new Client([
            'handler' => $this->createHandlerStack(),
            'base_uri' => $this->base_uri(),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    private function base_uri()
    {
        $url = "{$this->endpoint}/companies/{$this->company}/";

        return $url;
    }

    private function createHandlerStack()
    {
        $stack = HandlerStack::create();
        $stack->push(Middleware::retry($this->retryMiddleware()));
        $stack->push(Middleware::mapRequest(function (Request $request) {
            if ($this->token) {
                return $request->withHeader('Authorization', "Bearer {$this->token}");
            }
            return $request;
        }));
        return $stack;
    }

    private function retryMiddleware()
    {
        return function ($retries, Request $request, Response $response = null, RequestException $exception = null) {
            if ($retries >= self::RETRIES_MAX) {
                return false;
            }

            if ($response) {
                if ($response->getStatusCode() === 401) {
                    $data = $this->login();
                    if (isset($data['access_token'])) {
                        $this->token = $data['access_token'];
                    }
                    return true;
                }
            }

            return false;
        };
    }

    private function login()
    {
        try {
            $response = $this->client->request('post', 'login', [
                'body' => json_encode([
                    'public_key' => $this->key,
                    'secret_key' => $this->secret
                ]),
                'base_uri' => $this->endpoint,
                'handler' => HandlerStack::create()
            ]);
        } catch (ClientException $ex) {
            $response = $ex->getResponse();
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}

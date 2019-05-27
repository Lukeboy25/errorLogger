<?php

namespace ErrorLogger\Helpers;

use GuzzleHttp\Client;

class Logger
{
    protected $client;
    public $additionalData = [];
    public $exception;

    public function __construct(array $exception = [])
    {
        $this->client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        $this->exception = $exception;
    }

    public function addAdditionalData(array $additionalData = [])
    {
        return $this->additionalData = $additionalData;
    }

    public function send()
    {
        $this->sendError();
    }

    private function sendError()
    {
        $local_url = 'https://error-dashboard.cdemo.nl/api/logs';

        $data = json_encode($this->exception);

        $response = $this->client->post($local_url, [
            'body' => $data
        ]);

        $response = json_decode($response->getBody(), true);

        return $response;
    }
}
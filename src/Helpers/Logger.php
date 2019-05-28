<?php

namespace ErrorLogger\Helpers;

use GuzzleHttp\Client;

class Logger
{
    private $client;
    public $additionalData = [];
    public $exception;

    public function __construct(array $exception = [])
    {
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
        $data = json_encode($this->exception);

        $this->client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => config('errorlogger.token')],
        ]);

        if(config('errorlogger.token') !== "") {
            $response = $this->client->post(config('errorlogger.dashboard_url'), [
                'body' => $data
            ]);

            $response = json_decode($response->getBody(), true);

            return $response;
        }

        return null;
    }
}
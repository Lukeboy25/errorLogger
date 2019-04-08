<?php

namespace ErrorLogger\Helpers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use GuzzleHttp\Client;

class Logger
{
    protected $client;
    private $config = [];
    public $additionalData = [];
    public $exception;

    public function __construct(array $exception = [])
    {
        $this->client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        $this->config['login_key'] = config('errorlogger.login_key', []);
        $this->config['project_key'] = config('errorlogger.project_key', []);
        $this->config['queue_enabled'] = config('errorlogger.queue.enabled', false);
        $this->config['queue_name'] = config('errorlogger.queue.name', null);

        $this->exception = $exception;
    }

    public function addAdditionalData(array $additionalData = [])
    {
        $this->additionalData = $additionalData;

        return $this;
    }

    public function send()
    {
        $this->sendError();
    }

    private function sendError()
    {
        $local_url = 'http://127.0.0.2:8000/api/logs';

        $data = json_encode($this->exception);

        $response = $this->client->post($local_url, [
            'body' => $data
        ]);

        $response = json_decode($response->getBody(), true);

        return $response;
    }

    /**
     * Get the authenticated user.
     *
     * Supported authentication systems: Laravel, Sentinel
     *
     * @return array|null
     */
    private function getUser()
    {
        if (function_exists('auth') && auth()->check()) {
            return auth()->user()->toArray();
        }

        if (class_exists(\Cartalyst\Sentinel\Sentinel::class) && $user = Sentinel::check()) {
            return $user->toArray();
        }

        return null;
    }
}
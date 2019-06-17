<?php

return [
    /*
     * Environments where ErrorLogger should report
     */
    'environment' => [
        'local',
        'api'
    ],

    /*
     * Set the sleep time between duplicate exceptions.
     */
    'sleep' => 5,

    /*
     * Set the url where to push the logs to
     */
    'dashboard_url' => 'https://error-dashboard.cdemo.nl/api/exceptions',

    /*
     * Set the token that allows you to send logs
     */
    'token' => env('ERROR_LOGGER_TOKEN'),

    /*
     * List of exceptions to skip sending.
     */
    'except' => [
        'Symfony\Component\HttpKernel\Exception\NotFoundHttpException',
    ],

];

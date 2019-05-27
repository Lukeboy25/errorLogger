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
     * List of exceptions to skip sending.
     */
    'except' => [
        'Symfony\Component\HttpKernel\Exception\NotFoundHttpException',
    ],

];

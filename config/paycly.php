<?php

return [

    /**
     * Public Key From RagaPay Dashboard
     *
     */
    'endpoint' => getenv('RAGAPAY_API_ENDPOINT'),
    'api_key' => getenv('RAGAPAY_API_KEY'),
    'api_secret' => getenv('RAGAPAY_API_PASSWORD'),
];
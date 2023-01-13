<?php

return [

    /**
     * Public Key From RagaPay Dashboard
     *
     */
    'endpoint' => getenv('PAYCLY_API_ENDPOINT'),
    'api_key' => getenv('PAYCLY_API_KEY'),
    'website_id' => getenv('PAYCLY_WEBSITE_ID'),
];
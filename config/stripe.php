<?php

return [

    /**
     * API config From Stripe Dashboard
     *
     */
    'api_key' => getenv('STRIPE_API_KEY'),
    'api_secret' => getenv('STRIPE_API_SECRET'),
];
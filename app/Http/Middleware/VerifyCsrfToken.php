<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
       //
       'ragapay_notifications',
       'verify_paycly_charge',
       'verify_cashonex_charge',
       'xpro_notifications',
    ];
}
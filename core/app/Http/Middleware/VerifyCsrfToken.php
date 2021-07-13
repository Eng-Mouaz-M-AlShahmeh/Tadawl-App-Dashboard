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
        // Disable for API post routes
        'api/v1/subscribe',
        'api/v1/contact',
        'api/v1/comment',
        'api/v1/order',
    ];
}

<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * URL yang harus dikecualikan dari CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}

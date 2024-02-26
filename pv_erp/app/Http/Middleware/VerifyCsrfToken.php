<?php

namespace App\Http\Middleware;

use App\Http\Controllers\UOMController;
use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Route::resource('backend/uoms/*', UOMController::class),
        'http://0.0.0.0:8000/backend/uoms/*',
        'http://0.0.0.0:8000/backend/brands/*',
        'http://0.0.0.0:8000/backend/locations/*',
    ];
}



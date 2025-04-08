<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,  
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $routeMiddleware = [
     
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class, 
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class, 
        'can' => \Illuminate\Auth\Middleware\Authorize::class, 
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class, 
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class, 
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class, 
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class, 
        'admin' => \App\Http\Middleware\IsAdmin::class,
        'isCustomer' => \App\Http\Middleware\IsCustomer::class, 
    ];
}

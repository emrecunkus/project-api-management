<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',  // API routes dosyasının yolu
        commands: __DIR__.'/../routes/console.php',
        health: '/up', // API health check URL'si
    )
    ->withMiddleware(function ($middleware) {
        // Middleware alias'larını tanımlıyoruz
      //  $middleware->alias('role', CheckRole::class); // CheckRole middleware'ini alias'lıyoruz
    })
    ->withExceptions(function ($exceptions) {
        // Burada özel exception handler'ları tanımlayabilirsiniz
    })
    ->create();

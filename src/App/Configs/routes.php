<?php

declare(strict_types=1);

namespace Emmac\Hello\App\Configs;

use Emmac\Hello\Framework\App;

// controllers
use Emmac\Hello\App\Controllers\{
    GeminiController,
};

function registerRoutes(App $app)
{
    // GET routes 
    $app->get('/', [GeminiController::class, 'questionText']);

    // POST routes
    $app->post('/text', [GeminiController::class, 'questionText']);
}

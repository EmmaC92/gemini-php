<?php

declare(strict_types=1);

namespace Emmac\Hello\App\Configs;

// framework and tools
use Emmac\Hello\App\Configs\Paths;
use Emmac\Hello\Framework\Container;

// contracts
use Emmac\Hello\App\Contracts\{
    AIEngineServiceInterface,
    RequestHandlerInterface,
    EngineTemplateServiceInterface,
};

// Services
use Emmac\Hello\App\Services\{
    GeminiAIEngineService,
    PHPRequestHandler,
    TwigEngineTemplateService,
};

// Repositories
$repositories = [];

// Services
$services = [
    AIEngineServiceInterface::class => fn ()       => new GeminiAIEngineService($_ENV['GEMINI_API_KEY']),
    RequestHandlerInterface::class => function (Container $container){
        $engineTemplateService = $container->get(EngineTemplateServiceInterface::class);

        return new PHPRequestHandler(
            viewsService: $engineTemplateService
        );
    },
    EngineTemplateServiceInterface::class => fn () => new TwigEngineTemplateService(Paths::VIEW),
];

return array_merge(
    $repositories,
    $services,
);

<?php

declare(strict_types=1);

namespace Emmac\Hello\App\Contracts;

interface EngineTemplateServiceInterface
{
    public function getView(string $path, array $params = []): mixed;

    public function renderView(string $view, array $params = []): void;

    public function setTemplateBasePath (string $basePath): void;
}
<?php

declare(strict_types=1);

namespace Emmac\Hello\App\Services;

use Emmac\Hello\App\Contracts\EngineTemplateServiceInterface;
use Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class TwigEngineTemplateService implements EngineTemplateServiceInterface
{
    private ?FilesystemLoader $loader = null;
    private ?Environment $twig = null;

    public function __construct(
        private string $templateBasePath
    ) {
        $this->setTemplateBasePath($templateBasePath);
        $this->twig = new Environment($this->loader, []);
    }

    public function getView(string $path,  array $params = []): string
    {
        return $this->twig->render($path, $params);
    }

    public function renderView(string $view, array $params = []) : void
    {
        echo $this->getView($view, $params);
    }

    public function setTemplateBasePath(string $basePath): void
    {
        $this->loader = new FilesystemLoader($basePath);
    }
}

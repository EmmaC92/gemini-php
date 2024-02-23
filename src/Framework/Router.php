<?php

declare(strict_types=1);

namespace Emmac\Hello\Framework;

use Emmac\Hello\Framework\Container;

class Router
{
    public function __construct(
        private array $routes = [],
        private ?Container $container = null
    ) {
        $definitions = include __DIR__ . '/../App/Configs/container-definitions.php';
        $this->container = new Container($definitions);
    }

    public function addRoute(string $method, string $path, array $controller): void
    {
        $method = strtoupper($method);
        $path = $this->sanitizePath($path);

        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
        ];
    }

    public function dispatch(string $method, string $path): void
    {
        $method = strtoupper($method);
        $path = $this->sanitizePath($path);

        foreach ($this->routes as $route) {
            if ($route['path'] !== $path || $route['method'] !== $method) {
                continue;
            }

            [$controllerClass, $function] = $route['controller'];

            $controller = $this->container ? $this->container->resolve($controllerClass) : new $controllerClass();

            $controller->$function();
        }

        return;
    }

    private function sanitizePath(string $path): string
    {
        $path = trim($path, '/');
        $path = "/$path/";
        return preg_replace('#[/]{2,}#', '/', $path);
    }
}

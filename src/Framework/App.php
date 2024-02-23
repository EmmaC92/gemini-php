<?php

declare(strict_types=1);

namespace Emmac\Hello\Framework;

use Emmac\Hello\Framework\Router;

class App
{
    public function __construct(
        private Router $router = new Router()
    ) {
    }

    public function get(string $path, array $controller): void
    {
        $this->router->addRoute('GET', $path, $controller);
    }

    public function post(string $path, array $controller): void
    {
        $this->router->addRoute('POST', $path, $controller);
    }

    public function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        try {
            $this->router->dispatch($method, $path);
        } catch (\Exception $ex) {
            echo '<pre>';
            echo "Error message: {$ex->getMessage()}.";
            echo '</pre>';
        }
    }
}

<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

// tools
use Emmac\Hello\Framework\App;
use Emmac\Hello\App\Configs\Paths;
use function Emmac\Hello\App\Configs\registerRoutes;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();

$app = new App();

registerRoutes($app);

return $app;
<?php

declare(strict_types=1);

namespace Emmac\Hello\App\Contracts;

Interface AIEngineServiceInterface
{
    public function interact(string $input): mixed;
}
<?php

declare(strict_types=1);

namespace Emmac\Hello\App\Contracts;

interface RequestHandlerInterface
{
    public function getRequest(string $param = null): mixed;

    public function checkRequest(string $param = null): bool;
}
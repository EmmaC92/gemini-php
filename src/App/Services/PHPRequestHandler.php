<?php

declare(strict_types=1);

namespace Emmac\Hello\App\Services;

use Emmac\Hello\App\Contracts\RequestHandlerInterface;
use Emmac\Hello\App\Contracts\EngineTemplateServiceInterface;

class PHPRequestHandler implements RequestHandlerInterface
{

    protected const POST_TEXT_PARAM = 'POST_TEXT_PARAM';

    public function __construct(
        protected EngineTemplateServiceInterface $viewsService,
    ) {
    }

    public function getRequest(string $param = null): string|bool
    {
        if (!$this->checkRequest($_POST[self::POST_TEXT_PARAM])) {
            $this->viewsService->renderView('index.html.twig');
            exit;
        }

        return $_POST[self::POST_TEXT_PARAM];
    }

    public function checkRequest(string $param = null): bool
    {
        return isset($param);
    }
}

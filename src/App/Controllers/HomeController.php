<?php

declare(strict_types=1);

namespace Emmac\Hello\App\Controllers;

use Emmac\Hello\App\Contracts\{
    AIEngineServiceInterface,
    RequestHandlerInterface,
    EngineTemplateServiceInterface,
};

class HomeController
{
    public function __construct(
        protected AIEngineServiceInterface $aIEngineService,
        protected RequestHandlerInterface $requestHandler,
        protected EngineTemplateServiceInterface $viewsService,
    ) {
    }

    public function index()
    {
        $requestText = $this->requestHandler->getRequest(); 
        $responseText = $this->aIEngineService->interact($requestText);

        $this->viewsService->renderView(
            'index.php.twig',
            [
                'request' => $requestText,
                'response' => $responseText
            ]
        );
    }
}

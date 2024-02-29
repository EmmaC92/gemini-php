<?php

declare(strict_types=1);

namespace Emmac\Hello\App\Services;

use Emmac\Hello\App\Contracts\AIEngineServiceInterface;
use GeminiAPI\Client as GeminiClient;
use GeminiAPI\Resources\Parts\TextPart;

class GeminiAIEngineService implements AIEngineServiceInterface
{
    public function __construct(
        protected GeminiClient $geminiClient
    ) {
    }
    public function interact(string $input): string
    {
        $response = $this->geminiClient->geminiPro()->generateContent(
            new TextPart($input),
        );

        return $response->text();
    }
}

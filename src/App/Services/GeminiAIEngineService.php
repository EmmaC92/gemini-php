<?php

declare(strict_types=1);

namespace Emmac\Hello\App\Services;

use Emmac\Hello\App\Contracts\AIEngineServiceInterface;
use GeminiAPI\Client as GeminiClient;
use GeminiAPI\Resources\Parts\TextPart;

class GeminiAIEngineService implements AIEngineServiceInterface
{
    private ?GeminiClient $client = null;

    public function __construct(
        string $geminiApiKey
    ) {
        $this->client = new GeminiClient($geminiApiKey);
    }

    public function interact(string $input): string
    {
        $response = $this->client->geminiPro()->generateContent(
            new TextPart($input),
        );
        
        return $response->text();
    }
}

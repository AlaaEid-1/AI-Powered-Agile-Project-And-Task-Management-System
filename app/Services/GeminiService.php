<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class GeminiService
{
    public function generateSprints(string $prompt)
    {
        $apiKey = env('GEMINI_API_KEY');
        $model = env('GEMINI_MODEL', 'gemini-2.5-flash');

        if (!$apiKey || $apiKey === 'PUT_YOUR_API_KEY_HERE') {
            throw new Exception('Google Gemini API Key is missing or invalid. Please check your .env file.');
        }

        $systemPrompt = 'You are an AI Sprint Planner. Return JSON only. No markdown formatting, no explanations. The JSON format must be strictly as follows:
{
  "backlog": [
    {
      "title": "",
      "description": ""
    }
  ],
  "sprints": [
    {
      "title": "",
      "goal": "",
      "tasks": [
        {
          "title": "",
          "description": "",
          "priority": "low|medium|high",
          "status": "todo"
        }
      ]
    }
  ]
}';

        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

        $response = Http::withoutVerifying()
            ->withOptions([
                \CURLOPT_CONNECTTIMEOUT => 120,
                \CURLOPT_TIMEOUT => 120,
            ])
            ->post($url, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $systemPrompt . "\n\nUser Request:\n" . $prompt]
                    ]
                ]
            ],
            'generationConfig' => [
                'responseMimeType' => 'application/json',
            ],
        ]);

        if ($response->failed()) {
            throw new Exception('Failed to connect to Gemini API: ' . $response->body());
        }

        $data = $response->json();
        $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!$text) {
            throw new Exception('Invalid response from Gemini API.');
        }

        // Clean up markdown in case the API ignores responseMimeType
        $text = str_replace(['```json', '```'], '', $text);

        $decoded = json_decode(trim($text), true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Failed to parse JSON response from Gemini API: ' . json_last_error_msg());
        }

        return $decoded;
    }
}

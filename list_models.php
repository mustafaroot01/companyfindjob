<?php
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['GEMINI_API_KEY'];

echo "Checking models for API key...\n";

$response = \Illuminate\Support\Facades\Http::get("https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}");

if ($response->failed()) {
    echo "Error: " . $response->body() . "\n";
} else {
    $models = $response->json();
    foreach ($models['models'] as $model) {
        echo "- " . $model['name'] . " (Methods: " . implode(', ', $model['supportedGenerationMethods']) . ")\n";
    }
}

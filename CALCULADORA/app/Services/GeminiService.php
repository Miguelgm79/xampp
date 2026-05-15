<?php
namespace App\Services; 
use Illuminate\Support\Facades\Http; 

class GeminiService 
{ 
    public function generateWord($tema) 
{ 
    $apiKey = config('services.gemini.key');
    
    // DEPURACIÓN TEMPORAL - borra esto cuando funcione
    \Log::info('API KEY usada: ' . $apiKey);
    \Log::info('¿Está vacía?: ' . (empty($apiKey) ? 'SÍ' : 'NO'));

    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-lite-latest:generateContent" . $apiKey; 

    $prompt = "Actúa como un backend para un juego del ahorcado. El usuario quiere el tema: '$tema'. Genera una palabra relacionada y una pista breve. Responde estrictamente en formato JSON: {\"palabra\": \"...\", \"pista\": \"...\"}"; 

    $response = Http::post($url, [ 
        'contents' => [ 
            ['parts' => [['text' => $prompt]]] 
        ] 
    ]); 

    $data = $response->json();

    // Loguear la respuesta completa para ver el error real
    \Log::info('Respuesta de Gemini:', $data);

    if (!isset($data['candidates'])) {
        throw new \Exception('Error de Gemini: ' . json_encode($data));
    }

    $jsonString = $data['candidates'][0]['content']['parts'][0]['text']; 
    $jsonString = str_replace(['```json', '```'], '', $jsonString);
     
    return json_decode(trim($jsonString), true);
}
} 
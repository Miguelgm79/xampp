<?php
namespace App\Services; 
use Illuminate\Support\Facades\Http; 

class GeminiService 
{ 
    public function generateWord($tema) 
    { 
        $apiKey = config('services.gemini.key'); 
        $url = 
"https://generativelanguage.googleapis.com/v1beta/models
/gemini-1.5-flash:generateContent?key=" . $apiKey; 
 
        $prompt = "Actúa como un backend para un juego 
del ahorcado. El usuario quiere el tema: '$tema'.  
                   Genera una palabra relacionada y una 
pista breve.  
                   Responde estrictamente en formato 
JSON: {\"palabra\": \"...\", \"pista\": \"...\"}"; 
 
        $response = Http::post($url, [ 
            'contents' => [ 
                ['parts' => [['text' => $prompt]]] 
            ] 
        ]); 
 
        // Extraemos el texto de la respuesta de Gemini y lo convertimos en array 
        $data = $response->json(); 
        $jsonString = 
        $data['candidates'][0]['content']['parts'][0]['text']; 
         
        return json_decode($jsonString, true); 
    } 
} 
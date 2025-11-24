<?php
function gerarDicaIA($prompt) {
    $apiKey = "AIzaSyBfx8Md_szeGCxTkAD-jD2RhF4jgFiQbx8"; 

    $url = "https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

    $data = [
        "contents" => [[
            "role" => "user",
            "parts" => [[
                "text" => $prompt
            ]]
        ]]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    if (!$response) {
        return "Erro ao conectar à API Gemini.";
    }

    $decoded = json_decode($response, true);
    return $decoded["candidates"][0]["content"]["parts"][0]["text"] ?? "Não foi possível gerar uma dica no momento.";
}
?>

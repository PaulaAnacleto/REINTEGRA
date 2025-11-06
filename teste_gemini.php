<?php
// ✅ Coloque sua chave real
$apiKey = "AIzaSyC_lhZBLNgSM_rEn_Flt2b1NTKD9cAkmQQ";

// ✅ URL da API Gemini (modelo atualizado)
$url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

// ✅ Corpo da requisição
$data = [
    "contents" => [[
        "role" => "user",
        "parts" => [[
            "text" => "Olá, Gemini! Gere uma mensagem de boas-vindas para o sistema REINTEGRA."
        ]]
    ]]
];

// ✅ Inicializa cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// ✅ Executa requisição
$response = curl_exec($ch);

// ✅ Verifica erros
if ($response === false) {
    echo "Erro cURL: " . curl_error($ch);
} else {
    $decoded = json_decode($response, true);
    echo "<pre>";
    print_r($decoded);
    echo "</pre>";

    // ✅ Exibe texto da resposta (se existir)
    if (isset($decoded["candidates"][0]["content"]["parts"][0]["text"])) {
        echo "<h3>Resposta do Gemini:</h3>";
        echo "<p>" . $decoded["candidates"][0]["content"]["parts"][0]["text"] . "</p>";
    }
}

curl_close($ch);
?>


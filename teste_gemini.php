<?php
// ✅ Chave da API (mantenha em local seguro, nunca em repositório público)
$apiKey = "AIzaSyBfx8Md_szeGCxTkAD-jD2RhF4jgFiQbx8"; 

// ✅ URL da API Gemini
$url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.0-flash:generateContent?key=" . $apiKey;

// ✅ Corpo da requisição
$data = [
    "contents" => [[
        "role" => "user",
        "parts" => [[
            "text" => "Olá, Gemini! Gere uma mensagem de boas-vindas para o sistema REINTEGRA."
        ]]
    ]]
];

// ✅ Função para enviar a requisição
function chamarGemini($url, $data, $tentativas = 3) {
    $tentativa = 0;
    do {
        $tentativa++;
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            echo "❌ Erro cURL: " . curl_error($ch) . "\n";
            curl_close($ch);
            sleep(2);
            continue;
        }

        $decoded = json_decode($response, true);
        curl_close($ch);

        // ✅ Trata erros da API (como 503)
        if (isset($decoded["error"])) {
            $code = $decoded["error"]["code"];
            $msg = $decoded["error"]["message"];
            echo "⚠️ Erro da API ($code): $msg\n";

            if ($code == 503 && $tentativa < $tentativas) {
                echo "🔄 Tentando novamente em 3 segundos...\n";
                sleep(3);
                continue;
            } else {
                return $decoded;
            }
        }

        return $decoded;
    } while ($tentativa < $tentativas);

    return null;
}

// ✅ Executa a chamada
$resposta = chamarGemini($url, $data);

// ✅ Mostra a resposta
if ($resposta) {
    echo "<pre>";
    print_r($resposta);
    echo "</pre>";

    if (isset($resposta["candidates"][0]["content"]["parts"][0]["text"])) {
        echo "<h3>💬 Resposta do Gemini:</h3>";
        echo "<p>" . nl2br($resposta["candidates"][0]["content"]["parts"][0]["text"]) . "</p>";
    }
} else {
    echo "❌ Não foi possível obter resposta do Gemini após várias tentativas.";
}
?>

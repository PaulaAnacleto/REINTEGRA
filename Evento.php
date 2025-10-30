<?php
// ATIVAR A EXIBIÇÃO DE TODOS OS ERROS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ============ NOVO PASSO DE DEPURAÇÃO ============
// Força o PHP a limpar qualquer cache de arquivos em memória (OPcache)
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "<p style='color:blue; font-weight:bold;'>INFO: opcache_reset() foi chamado.</p>";
} else {
    echo "<p style='color:orange; font-weight:bold;'>AVISO: opcache_reset() não existe. O OPcache pode não estar ativo.</p>";
}
// ===============================================

echo "<h1>Depuração Nível 6 (Checando o arquivo da Classe)</h1>";

// 1. Incluir o autoload
require_once __DIR__ . '/vendor/autoload.php';
echo "<p style='color:green; font-weight:bold;'>Passo 1: Autoload do Composer carregado com sucesso.</p>";
echo "<hr>";

// ============ NOVO PASSO DE DEPURAÇÃO ============
echo "<h2>Passo 1.5: Verificando o arquivo da classe Google...</h2>";
$google_class_file = __DIR__ . '/vendor/google/apiclient/src/Client.php';
echo "<p>Procurando pelo arquivo da classe em: <code>" . $google_class_file . "</code></p>";

if (is_readable($google_class_file)) {
    echo "<p style='color:green; font-weight:bold;'>SUCESSO! O arquivo da classe 'Client.php' foi encontrado e pode ser lido.</p>";
    echo "<p>Isso torna o erro 'Class not found' ainda mais estranho. O problema está no mapa do autoloader.</p>";
} else {
    echo "<h2 style='color:red;'>ERRO FATAL (Verificação da Classe)</h2>";
    echo "<p><b>BINGO! O arquivo <code>/vendor/google/apiclient/src/Client.php</code> não foi encontrado ou não pode ser lido.</b></p>";
    echo "<p>Isso prova que a sua instalação do Composer (pasta 'vendor') está <b>CORROMPIDA</b> ou com permissões erradas.</p>";
    echo "<p>Delete a pasta 'vendor' e o 'composer.lock' e rode 'composer install' NOVAMENTE.</p>";
    // Sair do script, pois o resto vai falhar
    exit;
}
// ===============================================

echo "<hr><h2>Passo 2: Procurando pelo arquivo JSON na pasta...</h2>";

// ... (O resto do script de depuração Nível 5) ...

$directory_path = __DIR__;
$files_in_directory = scandir($directory_path);
$json_file_name = null;
foreach ($files_in_directory as $file) {
    if (strpos($file, 'calendario-') === 0 && strpos($file, '.json') !== false) {
        $json_file_name = $file;
        break;
    }
}

if ($json_file_name === null) {
    echo "<h2 style='color:red;'>ERRO FATAL (scandir)</h2>";
    echo "<p>A função 'scandir' não encontrou nenhum arquivo JSON que comece com 'calendario-'.</p>";
    exit;
} else {
    echo "<p style='color:green; font-weight:bold;'>Passo 2.1: 'scandir' encontrou o arquivo!</p>";
    echo "<p>Nome do arquivo encontrado: <code>" . $json_file_name . "</code></p>";
    $full_path = $directory_path . '/' . $json_file_name;
    
    echo "<hr><h2>Passo 3: Verificando Permissões (Agora com o nome do scandir)</h2>";

    if (!is_readable($full_path)) {
        echo "<h2 style='color:red;'>ERRO FATAL (is_readable)</h2>";
        echo "<p><b>BINGO! Encontramos o problema.</b></p>";
        echo "<p>O PHP encontrou o arquivo, mas <b>NÃO TEM PERMISSÃO para lê-lo</b>.</p>";
        exit;
    } else {
        echo "<p style='color:green; font-weight:bold;'>Passo 3.1: Permissões OK! O arquivo foi encontrado E o PHP pode lê-lo.</p>";
        echo "<hr><h2>Passo 4: Conectando ao Google...</h2>";
        
        try {
            $CALENDAR_ID = 'e9d55ddc0008700992e8636c307d0a940e9c6153ef8b1c59feee97b0530926ec@group.calendar.google.com';

            $client = new \Google\Client(); // Esta é a linha que estava falhando (linha 66 no script anterior)
            $client->setApplicationName("Meu App de Calendario PHP");
            $client->setScopes([\Google\Service\Calendar::CALENDAR]);
            
            echo "<p>Executando setAuthConfig()...</p>";
            $client->setAuthConfig($full_path);
            echo "<p style='color:green;'>setAuthConfig() executado com sucesso!</p>";

            $service = new \Google\Service\Calendar($client);
            echo "<p>Serviço do Calendário inicializado.</p>";

            $event = new \Google\Service\Calendar\Event([
                'summary' => 'Evento de Teste (Depuração Nível 6)',
                'start' => ['dateTime' => '2025-10-30T10:00:00-03:00', 'timeZone' => 'America/Sao_Paulo'],
            'end' => ['dateTime' => '2025-10-30T11:00:00-03:00', 'timeZone' => 'America/Sao_Paulo'],
            ]);
            echo "<p>Objeto de evento criado.</p>";

            echo "<p>Inserindo evento...</p>";
            $createdEvent = $service->events->insert($CALENDAR_ID, $event);

            echo "<hr>";
            echo "<h1 style='color:blue;'>EVENTO CRIADO COM SUCESSO!</h1>";
            echo "<p>Veja em: " . $createdEvent->getHtmlLink() . "</p>";
            echo "<p>Agora, vá para a sua página 'Agendador.php' e ATUALIZE (F5)!</p>";

        } catch (Exception $e) {
            echo '<h1 style="color:red;">Ocorreu um erro (Dentro do TRY):</h1>';
            echo '<p>As verificações de arquivo passaram, mas a biblioteca do Google falhou. Este é o erro *real* que o Google está enviando:</p>';
            echo '<pre>' . $e->getMessage() . '</pre>';
        }
    }
}
?>
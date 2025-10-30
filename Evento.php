<?php
// ATIVAR A EXIBIÇÃO DE TODOS OS ERROS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Depuração Nível 3 (Confiando no scandir)</h1>";

// 1. Incluir o autoload
require_once __DIR__ . '/vendor/autoload.php';
echo "<p style='color:green; font-weight:bold;'>Passo 1: Autoload do Composer carregado com sucesso.</p>";
echo "<hr>";

echo "<h2>Passo 2: Procurando pelo arquivo JSON na pasta...</h2>";

$directory_path = __DIR__;
$files_in_directory = scandir($directory_path);

$json_file_name = null;

// Loop para encontrar o arquivo JSON
foreach ($files_in_directory as $file) {
    // Procuramos por um arquivo que termine com .json e contenha "calendario"
    if (strpos($file, 'calendario-') === 0 && strpos($file, '.json') !== false) {
        $json_file_name = $file; // Encontramos!
        break;
    }
}

if ($json_file_name === null) {
    echo "<h2 style='color:red;'>ERRO FATAL (scandir)</h2>";
    echo "<p>A função 'scandir' não encontrou nenhum arquivo JSON que comece com 'calendario-'.</p>";
    echo "<p>Verifique se o arquivo <code>calendario-476614-d88640ddff36.json</code> está mesmo na pasta.</p>";
    echo "<pre>";
    print_r($files_in_directory);
    echo "</pre>";

} else {
    echo "<p style='color:green; font-weight:bold;'>Passo 2.1: 'scandir' encontrou o arquivo!</p>";
    echo "<p>Nome do arquivo encontrado: <code>" . $json_file_name . "</code></p>";

    $full_path = $directory_path . '/' . $json_file_name;
    
    echo "<hr><h2>Passo 3: Verificando Permissões (Agora com o nome do scandir)</h2>";

    if (!file_exists($full_path)) {
        echo "<h2 style='color:red;'>ERRO FATAL (Contradição)</h2>";
        echo "<p>'scandir' encontrou o arquivo, mas 'file_exists' AINDA falha. Isso é muito estranho.</p>";
        echo "<p>Caminho checado: <code>" . $full_path . "</code></p>";

    } elseif (!is_readable($full_path)) {
        echo "<h2 style='color:red;'>ERRO FATAL (is_readable)</h2>";
        echo "<p><b>BINGO! Encontramos o problema.</b></p>";
        echo "<p>O PHP encontrou o arquivo, mas <b>NÃO TEM PERMISSÃO para lê-lo</b>.</p>";
        echo "<p>Clique com o botão direito no arquivo <code>" . $json_file_name . "</code> > Propriedades > Segurança e dê ao usuário 'Todos' ou 'Usuários Autenticados' a permissão de 'Leitura'.</p>";
    
    } else {
        echo "<p style='color:green; font-weight:bold;'>Passo 3.1: Permissões OK! O arquivo foi encontrado E o PHP pode lê-lo.</p>";
        echo "<hr><h2>Passo 4: Conectando ao Google...</h2>";
        
        // Se tudo estiver OK, TENTAR conectar
        try {
            $CALENDAR_ID = 'e9d55ddc0008700992e8636c307d0a940e9c6153ef8b1c59feee97b0530926ec@group.calendar.google.com';

            $client = new Google_Client();
            $client->setApplicationName("Meu App de Calendario PHP");
            $client->setScopes([Google_Service_Calendar::CALENDAR]);
            
            echo "<p>Executando setAuthConfig()...</p>";
            $client->setAuthConfig($full_path); // Usando o $full_path verificado
            echo "<p style='color:green;'>setAuthConfig() executado com sucesso!</p>";

            $service = new Google_Service_Calendar($client);
            echo "<p>Serviço do Calendário inicializado.</p>";

            $event = new Google_Service_Calendar_Event([
                'summary' => 'Evento de Teste (Depuração Nível 3)',
                'start' => ['dateTime' => '2025-11-20T14:00:00-03:00', 'timeZone' => 'America/Sao_Paulo'],
                'end' => ['dateTime' => '2025-11-20T15:00:00-03:00', 'timeZone' => 'America/Sao_Paulo'],
            ]);
            echo "<p>Objeto de evento criado.</p>";

            echo "<p>Inserindo evento...</p>";
            $createdEvent = $service->events->insert($CALENDAR_ID, $event);

            echo "<hr>";
            echo "<h1 style='color:blue;'>EVENTO CRIADO COM SUCESSO!</h1>";
            echo "<p>Veja em: " . $createdEvent->getHtmlLink() . "</p>";

        } catch (Exception $e) {
            echo '<h1 style="color:red;">Ocorreu um erro (Dentro do TRY):</h1>';
            echo '<p>As verificações de arquivo passaram, mas a biblioteca do Google falhou. Este é o erro *real* que o Google está enviando:</p>';
            echo '<pre>' . $e->getMessage() . '</pre>';
        }
    }
}
?>
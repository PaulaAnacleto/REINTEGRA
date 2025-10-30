<?php
// Crie este arquivo como 'Criar-evento.php' na pasta raiz REINTEGRA

// 1. Incluir o autoload (essencial)
require_once __DIR__ . '/vendor/autoload.php';

// Apenas execute se o formulário for enviado (método POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ===================================================================
    // CORREÇÃO DO ERRO (NOME DO ARQUIVO)
    // ===================================================================
    // O nome do arquivo estava com 'd88' em vez de 'd98'
    $SERVICE_ACCOUNT_FILE = __DIR__ . '/calendario-476614-d98640ddff36.json'; // NOME CORRIGIDO!
    $CALENDAR_ID = 'e9d55ddc0008700992e8636c307d0a940e9c6153ef8b1c59feee97b0530926ec@group.calendar.google.com';
    // ===================================================================


    // 3. Pegar os dados do formulário
    $titulo = $_POST['titulo'];
    $data_inicio = $_POST['data_inicio'];   // Formato: YYYY-MM-DD
    $data_fim = $_POST['data_fim'];         // Formato: YYYY-MM-DD
    $hora_inicio = $_POST['hora_inicio'];   // Formato: HH:MM
    $hora_fim = $_POST['hora_fim'];         // Formato: HH:MM
    $descricao = $_POST['descricao'] ?? ''; 

    // 4. Formatar a data/hora para o padrão do Google (RFC3339)
    $fuso_horario = 'America/Sao_Paulo'; 
    $datetime_inicio_formatado = sprintf('%sT%s:00', $data_inicio, $hora_inicio); // Combina data de início com hora de início
    $datetime_fim_formatado = sprintf('%sT%s:00', $data_fim, $hora_fim);         // Combina data de fim com hora de fim

    try {
        // 5. Autenticação (usando o nome completo da classe com \)
        $client = new \Google\Client();
        $client->setApplicationName("Meu App de Calendario PHP");
        $client->setScopes([\Google\Service\Calendar::CALENDAR]);
        $client->setAuthConfig($SERVICE_ACCOUNT_FILE); // Vai ler o arquivo com o nome correto agora

        $service = new \Google\Service\Calendar($client);

        // 6. Criar o objeto do evento COM AS VARIÁVEIS DO FORMULÁRIO
        $event = new \Google\Service\Calendar\Event([
            'summary' => $titulo,
            'description' => $descricao,
            'start' => [
                'dateTime' => $datetime_inicio_formatado,
                'timeZone' => $fuso_horario,
            ],
            'end' => [
                'dateTime' => $datetime_fim_formatado,
                'timeZone' => $fuso_horario,
            ],
        ]);

        // 7. Inserir o evento no calendário
        $createdEvent = $service->events->insert($CALENDAR_ID, $event);

        // 8. Redirecionar de volta para o Agendador (caminho corrigido)
        header('Location: View/Agendador.php');
        exit;

    } catch (Exception $e) {
        // Tratar erros
        echo 'Ocorreu um erro ao criar o evento: ' . $e->getMessage();
    }
} else {
    // Se alguém tentar acessar criar_evento.php diretamente
    header('Location: View/Agendador.php');
    exit;
}
?>
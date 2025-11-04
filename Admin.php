<?php
// =========================================================================
// ADMIN.PHP (Arquivo Único de Gerenciamento CRUD) - CSS SEPARADO
// =========================================================================

ini_set('display_errors', 1);
error_reporting(E_ALL);

// 1. Incluir o autoload (essencial)
require_once __DIR__ . '/vendor/autoload.php';

// 2. Definir os caminhos e IDs (constantes)
define('SERVICE_ACCOUNT_FILE', __DIR__ . '/calendario-476614-d98640ddff36.json');
define('CALENDAR_ID', 'e9d55ddc0008700992e8636c307d0a940e9c6153ef8b1c59feee97b0530926ec@group.calendar.google.com');

$acao = $_GET['action'] ?? 'listar'; // Ação padrão: 'listar'
$evento_para_editar = null;
$mensagem_sucesso = '';
$mensagem_erro = '';
$fuso_horario = 'America/Sao_Paulo'; // Defina seu fuso horário

// =========================================================================
// PARTE 1: PROCESSAR AÇÕES (POST ou GET)
// =========================================================================
try {
    // Inicializar o Cliente Google
    $client = new \Google\Client();
    $client->setApplicationName("Meu Gerenciador de Calendário");
    $client->setScopes([\Google\Service\Calendar::CALENDAR]); // Escopo completo
    $client->setAuthConfig(SERVICE_ACCOUNT_FILE);
    $service = new \Google\Service\Calendar($client);

    // --- AÇÃO: CRIAR (Vem do formulário 'criar') ---
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'criar') {
        $datetime_inicio = sprintf('%sT%s:00', $_POST['data_inicio'], $_POST['hora_inicio']);
        $datetime_fim = sprintf('%sT%s:00', $_POST['data_fim'], $_POST['hora_fim']);
        $event = new \Google\Service\Calendar\Event([
            'summary' => $_POST['titulo'], 'description' => $_POST['descricao'] ?? '',
            'start' => ['dateTime' => $datetime_inicio, 'timeZone' => $fuso_horario],
            'end' => ['dateTime' => $datetime_fim, 'timeZone' => $fuso_horario],
        ]);
        $service->events->insert(CALENDAR_ID, $event);
        $mensagem_sucesso = 'Evento criado com sucesso!';
        $acao = 'listar'; 
    }

    // --- AÇÃO: ATUALIZAR (Vem do formulário 'editar') ---
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'atualizar') {
        $event_id = $_POST['event_id'];
        $event = $service->events->get(CALENDAR_ID, $event_id);
        $event->setSummary($_POST['titulo']);
        $event->setDescription($_POST['descricao'] ?? '');
        $datetime_inicio = sprintf('%sT%s:00', $_POST['data_inicio'], $_POST['hora_inicio']);
        $datetime_fim = sprintf('%sT%s:00', $_POST['data_fim'], $_POST['hora_fim']);
        $start = new \Google_Service_Calendar_EventDateTime();
        $start->setDateTime($datetime_inicio); $start->setTimeZone($fuso_horario);
        $event->setStart($start);
        $end = new \Google_Service_Calendar_EventDateTime();
        $end->setDateTime($datetime_fim); $end->setTimeZone($fuso_horario);
        $event->setEnd($end);
        $service->events->update(CALENDAR_ID, $event->getId(), $event);
        $mensagem_sucesso = 'Evento atualizado com sucesso!';
        $acao = 'listar';
    }
    
    // --- AÇÃO: EXCLUIR (Vem de um link GET) ---
    if ($acao == 'excluir' && isset($_GET['id'])) {
        $service->events->delete(CALENDAR_ID, $_GET['id']);
        header('Location: Admin.php?sucesso=excluido');
        exit;
    }
    
    // --- AÇÃO: EDITAR (Vem de um link GET) ---
    if ($acao == 'editar' && isset($_GET['id'])) {
        $event = $service->events->get(CALENDAR_ID, $_GET['id']);
        $data_inicio_obj = new DateTime($event->start->dateTime);
        $data_fim_obj = new DateTime($event->end->dateTime);
        $evento_para_editar = [
            'id' => $event->getId(), 'titulo' => $event->getSummary(), 'descricao' => $event->getDescription(),
            'data_inicio' => $data_inicio_obj->format('Y-m-d'), 'hora_inicio' => $data_inicio_obj->format('H:i'),
            'data_fim' => $data_fim_obj->format('Y-m-d'), 'hora_fim' => $data_fim_obj->format('H:i'),
        ];
    }
    
    // --- AÇÃO PADRÃO: LISTAR ---
    if ($acao == 'listar') {
        $optParams = ['timeMin' => date('c'), 'orderBy' => 'startTime', 'singleEvents' => true];
        $results = $service->events->listEvents(CALENDAR_ID, $optParams);
        $events = $results->getItems();
    }
    
    if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'excluido') {
        $mensagem_sucesso = 'Evento excluído com sucesso!';
    }

} catch (Exception $e) {
    $mensagem_erro = 'Ocorreu um erro: ' . $e->getMessage();
    $acao = 'listar';
    if (!isset($events)) { $events = []; } // Garante que $events exista mesmo se a API falhar
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Gerenciador de Eventos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../Reintegra/Templates/css/Admin.css">

</head>
<body class="admin-page">   <div class="container my-5">
    <div class="row g-5">       <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            
                        <?php if ($acao == 'editar' && $evento_para_editar): ?>
                            <h3 class="mb-3 text-center">Editar Evento</h3>
                <form action="Admin.php" method="POST">
                                <input type="hidden" name="action" value="atualizar">
                                <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($evento_para_editar['id']); ?>">
                  <div class="mb-3">
                    <label for="titulo" class="form-label">Título do Evento</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($evento_para_editar['titulo']); ?>" required>
                  </div>
                  <div class="row">
                    <div class="col-6 mb-3"><label for="data_inicio">Data Início</label><input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?php echo htmlspecialchars($evento_para_editar['data_inicio']); ?>" required></div>
                    <div class="col-6 mb-3"><label for="data_fim">Data Fim</label><input type="date" class="form-control" id="data_fim" name="data_fim" value="<?php echo htmlspecialchars($evento_para_editar['data_fim']); ?>" required></div>
                  </div>
                  <div class="row">
                    <div class="col-6 mb-3"><label for="hora_inicio">Hora Início</label><input type="time" class="form-control" id="hora_inicio" name="hora_inicio" value="<?php echo htmlspecialchars($evento_para_editar['hora_inicio']); ?>" required></div>
                    <div class="col-6 mb-3"><label for="hora_fim">Hora Fim</label><input type="time" class="form-control" id="hora_fim" name="hora_fim" value="<?php echo htmlspecialchars($evento_para_editar['hora_fim']); ?>" required></div>
                  </div>
                  <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição (Opcional)</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3"><?php echo htmlspecialchars($evento_para_editar['descricao']); ?></textarea>
                  </div>
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="Admin.php" class="btn btn-secondary me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                  </div>
            </form>
                        
                        <?php else: ?>
                                            <h3 class="mb-3 text-center">Criar Novo Evento</h3>
                <form action="Admin.php" method="POST">
                                <input type="hidden" name="action" value="criar">
                  <div class="mb-3">
                    <label for="titulo" class="form-label">Título do Evento</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                  </div>
                  <div class="row">
                    <div class="col-6 mb-3"><label for="data_inicio">Data Início</label><input type="date" class="form-control" id="data_inicio" name="data_inicio" required></div>
                    <div class="col-6 mb-3"><label for="data_fim">Data Fim</label><input type="date" class="form-control" id="data_fim" name="data_fim" required></div>
                  </div>
                  <div class="row">
                    <div class="col-6 mb-3"><label for="hora_inicio">Hora Início</label><input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required></div>
                    <div class="col-6 mb-3"><label for="hora_fim">Hora Fim</label><input type="time" class="form-control" id="hora_fim" name="hora_fim" required></div>
                  </div>
                  <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição (Opcional)</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                  </div>
                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Salvar Evento</button>
                  </div>
            </form>
                        <?php endif; ?>
          </div>
        </div>
      </div>

                  <div class="col-md-7">
        <h2 class="mb-4">Próximos Eventos</h2>
                
                <?php if ($mensagem_sucesso): ?>
                    <div class="alert alert-success"><?php echo $mensagem_sucesso; ?></div>
                <?php endif; ?>
                <?php if ($mensagem_erro): ?>
                    <div class="alert alert-danger"><?php echo $mensagem_erro; ?></div>
                <?php endif; ?>
                
        <div class="card shadow-sm">
          <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th class="p-3">Evento</th>
                  <th class="p-3">Início</th>
                  <th class="text-end p-3">Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($events) && !$mensagem_erro): ?>
                  <tr>
                    <td colspan="3" class="text-center text-muted p-4">Nenhum evento futuro encontrado.</td>
                  </tr>
                <?php elseif (!empty($events)): ?>
                  <?php foreach ($events as $event): ?>
                    <?php $start = new DateTime($event->start->dateTime); ?>
                    <tr>
                      <td class="p-3"><strong><?php echo htmlspecialchars($event->getSummary()); ?></strong></td>
                      <td class="p-3"><?php echo $start->format('d/m/Y H:i'); ?></td>
                      <td class="text-end p-3">
                    <a href="Admin.php?action=editar&id=<?php echo $event->getId(); ?>" class="btn btn-sm btn-outline-secondary me-2">
                          <i class="bi bi-pencil"></i>
                    </a>
                        <a href="Admin.php?action=excluir&id=<?php echo $event->getId(); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza?');">
                          <i class="bi bi-trash"></i>
                  </a>
                    </td>
             </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>   </div>
  </div>
 </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// 1. Inclui o Controller (caminho sobe 1 nível: View/ -> Reintegra/ -> Controller/)
require_once __DIR__ . '/../Controller/Cursos_controller.php';

// 2. Inicializa o Controller e processa ações (Criar, Atualizar, Excluir)
$controller = new CursosController();
// Inicia $dados_view como um array vazio por segurança
$dados_view = ['acao' => 'listar', 'curso' => null];
$dados_view = array_merge($dados_view, $controller->handleAdminRequest());

// 3. Define o modo do formulário (Criar ou Editar)
$modo_edicao = ($dados_view['acao'] == 'editar');
$curso_atual = $dados_view['curso'] ?? null; // Dados para preencher o form se estiver editando

// 4. Busca a lista de cursos para exibir na tabela
// (Usamos um novo controller para não misturar com a lógica de ação)
$list_controller = new CursosController();
$cursos_cadastrados = $list_controller->getCursosPublico();

// 5. Tratar mensagens de sucesso (via GET)
$mensagem_sucesso = '';
if (isset($_GET['sucesso'])) {
    if ($_GET['sucesso'] == 'criado') $mensagem_sucesso = 'Curso criado com sucesso!';
    if ($_GET['sucesso'] == 'atualizado') $mensagem_sucesso = 'Curso atualizado com sucesso!';
    if ($_GET['sucesso'] == 'excluido') $mensagem_sucesso = 'Curso excluído com sucesso!';
}
$mensagem_erro = $dados_view['erro'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Admin - Gerenciador de Cursos</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Caminho do CSS está correto (../Templates/css/...) -->
 <link rel="stylesheet" href="../Templates/css/Criar_cursos.css"> 
</head>
<body class="admin-page">


 <div class="btn-retorno">
    <button class="back-button" aria-label="Voltar">
      <img src="../Img/página de contato/seta.png" alt="Voltar" class="back-icon">
    </button>
  </div>

 <div class="container my-5">
  <div class="row g-5">  
      <!-- Coluna dos Formulários -->
   <div class="col-md-5">
    <div class="card shadow-sm">
     <div class="card-body p-4">
      
            <!-- Título dinâmico -->
      <h3 id="form-title" class="mb-3 text-center">
                <?php echo $modo_edicao ? 'Editar Curso' : 'Criar Novo Curso'; ?>
            </h3>
            <!-- Formulário agora é PHP, aponta para ele mesmo -->
      <form id="course-form" action="Criar_cursos.php" method="POST">
              
                <!-- Define a ação (criar ou atualizar) -->
                <?php if ($modo_edicao): ?>
                    <input type="hidden" name="action" value="atualizar">
                    <input type="hidden" name="course_id" value="<?php echo $curso_atual['idcurso']; ?>">
                <?php else: ?>
                    <input type="hidden" name="action" value="criar">
                <?php endif; ?>

       <div class="mb-3">
        <label for="titulo" class="form-label">Título do Curso</label>
                <!-- Preenche o valor se estiver editando -->
        <input type="text" class="form-control" id="titulo" name="titulo" 
                       value="<?php echo htmlspecialchars($curso_atual['Titulo'] ?? ''); ?>" required>
       </div>
       <div class="mb-3">
        <label for="link_externo" class="form-label">Link Externo (URL)</label>
        <input type="url" class="form-control" id="link_externo" name="link_externo" 
                       placeholder="https://www.empresa.com/curso" 
                       value="<?php echo htmlspecialchars($curso_atual['Links'] ?? ''); ?>" required>
       </div>
       <div class="mb-3">
        <label for="descricao" class="form-label">Descrição Curta</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="4" 
                          placeholder="Ex: Modelos de Negócios..."><?php echo htmlspecialchars($curso_atual['Descricao_cur'] ?? ''); ?></textarea>
       </div>
       <div class="d-grid gap-2">
                <!-- Texto do botão muda dinamicamente -->
        <button type="submit" id="submit-button" class="btn btn-primary btn-lg">
                    <?php echo $modo_edicao ? 'Salvar Alterações' : 'Salvar Novo Curso'; ?>
                </button>
                <!-- Botão Cancelar (só aparece na edição) -->
                <?php if ($modo_edicao): ?>
          <a href="Criar_cursos.php" id="cancel-button" class="btn btn-secondary">Cancelar Edição</a>
                <?php endif; ?>
       </div>
      </form>
     </div>
    </div>
   </div>

      <!-- Coluna da Lista de Cursos -->
   <div class="col-md-7">

            <!-- ============================================== -->
            <!-- BOTÃO ADICIONADO AQUI -->
            <!-- ============================================== -->
            <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Cursos Cadastrados</h2>
                <!-- Este botão abre a página Cursos.php em uma nova aba -->
                <a href="Cursos.php" target="_blank" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill me-1"></i> Visualizar Página Pública
                </a>
            </div>
            <!-- ============================================== -->
            <!-- FIM DA ADIÇÃO -->
            <!-- ============================================== -->

        
        <!-- Mensagens de Sucesso ou Erro (controladas via PHP) -->
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
         <th class="p-3">Título</th>
         <th class="p-3">Link</th>
         <th class="text-end p-3">Ações</th>
        </tr>
       </thead>
       <!-- Tabela agora é preenchida com PHP -->
       <tbody id="courses-table-body">
                <?php if (empty($cursos_cadastrados)): ?>
         <tr>
          <td colspan="3" class="text-center text-muted p-4">Nenhum curso cadastrado.</td>
         </tr>
                <?php else: ?>
                    <?php foreach ($cursos_cadastrados as $curso): ?>
                        <tr>
                            <td class="p-3"><strong><?php echo htmlspecialchars($curso['Titulo']); ?></strong></td>
                            <td class="p-3">
                                <?php $shortLink = strlen($curso['Links']) > 30 ? substr($curso['Links'], 0, 30) . '...' : $curso['Links']; ?>
                                <a href="<?php echo htmlspecialchars($curso['Links']); ?>" target="_blank"><?php echo htmlspecialchars($shortLink); ?></a>
                            </td>
                            <td class="text-end p-3">
                                <!-- Botão Editar -->
                                <a href="Criar_cursos.php?action=editar&id=<?php echo $curso['idcurso']; ?>" class="btn btn-sm btn-outline-secondary me-2">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <!-- Botão Excluir -->
                                <a href="Criar_cursos.php?action=excluir&id=<?php echo $curso['idcurso']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
       </tbody>
      </table>
     </div>
    </div>
   </div>
  </div>
 </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
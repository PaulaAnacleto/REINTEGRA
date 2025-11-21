<?php
// 1. Inclui o Controller
require_once __DIR__ . '/../Controller/Cursos_controller.php';

// 2. Inicializa o Controller e busca os cursos
$controller = new CursosController();
$cursos = $controller->getCursosPublico();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cursos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="../Templates/css/cursos.css">
</head>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm" id="navbar">
  <div class="container">
    <a class="navbar-brand" href="#">
      <div class="logo-box">
        <span class="logo-text">REINTEGRA</span>
      </div>
    </a>



    <!-- Perfil + botão hamburguer (visível apenas no mobile) -->
    <div class="d-flex align-items-center">
      <a href="../View/Perfil.php" class="d-lg-none me-2">
        <button class="btn-perfil">
          <img src="../Img/página de perfil/icone perfil.png" class="img-perfil" alt="Perfil">
        </button>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>



    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="../View/Servicos.php">Serviços</a></li>
        <li class="nav-item"><a class="nav-link" href="../View/Inicial-login.php">Feedback</a></li>
        <li class="nav-item"><a class="nav-link" href="../View/Contato.php">Contato</a></li>
        <li class="nav-item"><a class="nav-link" href="../View/Inicial-login.php">Sobre</a></li>
        <li class="nav-item"><a class="nav-link" href="../View/Inicial-login.php">Início</a></li>

        <!-- Perfil visível apenas no desktop -->

        <li class="nav-item d-none d-lg-block">
          <a href="../View/Perfil.php">
            <button class="btn-perfil" id="perfil">
              <img src="../Img/página de perfil/icone perfil.png" class="img-perfil" alt="Perfil">
            </button>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!-- Header -->
<header class="header">
  <div class="btn-retorno">
    <button class="back-button" aria-label="Voltar">
      <img src="../Img/página de contato/seta.png" alt="Voltar" class="back-icon">
    </button>
  </div>
</header>
<body>


    <div vw class="enabled">
  <div vw-access-button class="active"></div>
  <div vw-plugin-wrapper>
    <div class="vw-plugin-top-wrapper"></div>
  </div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
  new window.VLibras.Widget('https://vlibras.gov.br/app' );
</script>


  <div class="inicio">
    <h1 class="title">Confira os <span>cursos disponíveis</span></h1>
    <p class="paragrafo">Invista no seu futuro profissional,
      explore nossos cursos e aperfeiçoe suas
      habilidades para alcançar <span>novas oportunidades </span>
      no mercado de trabalho!
    </p>
  </div>

  <main class="conteudo">

        
        <?php if (empty($cursos)): ?>
            <div class="card">
                <p class="text-card">Nenhum curso disponível no momento. Volte em breve!</p>
            </div>
        <?php else: ?>
            <?php foreach ($cursos as $curso): ?>
                <!-- Cada card agora é um link que usa a coluna 'Links' -->
                <a href="<?php echo htmlspecialchars($curso['Links']); ?>" target="_blank" class="card-link" id="linkcard">
                    <div class="card">
                        <h3><?php echo htmlspecialchars($curso['Titulo']); ?></h3>
                        <p class="text-card"><?php echo htmlspecialchars($curso['Descricao_cur']); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
        

        <!-- LOOP DE CARDS DINÂMICOS - FIM -->

  </main>

  <!-- Footer Section -->
  <footer class="footer">
    <div class="footer-links">
      <p class="footer-text">
        © 2025 Reintegra. Todos os direitos reservados.
      </p>
          <a href="View/Politica-privacidade.php" class="footer-link">Política de Privacidade</a>
          <a href="View/termos-servico.php" class="footer-link">Termos de Serviço</a>
    </div>
  </footer>

 <!-- Bootstrap JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
 <!-- JS -->
 <script src="../Templates/js/cursos.js"></script>

</body>
</html>
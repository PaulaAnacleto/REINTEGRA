<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vagas - Reintegra</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../Templates/css/vagas.css">
</head>
<body>

    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
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
        <li class="nav-item"><a class="nav-link" href="../view/Servicos">Serviços</a></li>
        <li class="nav-item"><a class="nav-link" href="#cadastro">Feedback</a></li>
        <li class="nav-item"><a class="nav-link" href="../View/Contato.php">Contato</a></li>
        <li class="nav-item"><a class="nav-link" href="#sobre">Sobre</a></li>
        <li class="nav-item"><a class="nav-link" href="../View/Inicial-login.php">Início</a></li>

        <!-- Perfil visível apenas no desktop -->
        <li class="nav-item d-none d-lg-block">
          <a href="../View/Perfil.php">
            <button class="btn-perfil">
              <img src="../Img/página de perfil/icone perfil.png" class="img-perfil" alt="Perfil">
            </button>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <!-- Botão Voltar -->
    <button class="back-button" aria-label="Voltar">
        <img src="../Img/página de contato/seta.png" alt="Voltar" class="back-icon">
    </button>
        <h1 class="hero-title">VAGAS</h1>
        <p class="hero-description">
            Encontre os melhores sites para descobrir oportunidades incríveis de emprego aqui!
        </p>
    </section>

    <!-- Component: Card Section -->
    <section class="content-section">

        <!-- CARD 2 -->
        <div class="card-item reverse">
            <div class="card-text">
                <h2 class="card-title">Indeed</h2>
                <ul>
                    <li>Possui milhares de vagas atualizadas diariamente.</li>
                    <li>Permite enviar currículos com facilidade e rapidez.</li>
                    <li>Filtros inteligentes para encontrar oportunidades por área e localização.</li>
                    <li>Clique e encontre sua vaga!</li>
                </ul>
                <a href="https://querobolsa.com.br/teste-vocacional-gratis?utm_source=" target="_blank"> <button class="btn-primary">Vagas</button href="../View/Curriculo.php"> </a>
            </div>
            <div class="card-image">
                <img src="../Img/página vagas/indeed.png" alt="Informações de contato" class="img-fluid">
            </div>
        </div>

        <!-- CARD 3 -->
        <div class="card-item">
            <div class="card-text">
                <h2 class="card-title">Infojobs</h2>
                <ul>
                    <li>Filtros avançados para facilitar sua busca. </li>
                    <li>Ferramentas para destacar seu perfil aos recrutadores.</li>
                    <li>Vagas para todos os níveis — do primeiro emprego à liderança.</li>
                    <li>Clique e encontre sua vaga!</li>
                </ul>
                <a href="https://querobolsa.com.br/teste-vocacional-gratis?utm_source=" target="_blank"> <button class="btn-primary">Vagas</button href="../View/Curriculo.php"> </a>
            </div>
            <div class="card-image">
                <img src="../Img/página vagas/infojobs.png" alt="Experiência profissional" class="img-fluid">
            </div>
        </div>

        <!-- CARD 4 -->
        <div class="card-item reverse">
            <div class="card-text">
                <h2 class="card-title">Catho</h2>
                <ul>
                    <li>Filtros avançados para facilitar sua busca.</li>
                    <li>Ferramentas para destacar seu perfil aos recrutadores.</li>
                    <li>Vagas para todos os níveis — do primeiro emprego à liderança.</li>
                    <li>Clique e encontre sua vaga!</li>
                </ul>
                <a href="https://querobolsa.com.br/teste-vocacional-gratis?utm_source=" target="_blank"> <button class="btn-primary">Vagas</button href="../View/Curriculo.php"> </a>
            </div>
            <div class="card-image">
                <img src="../Img/página vagas/catho.png" alt="Formação acadêmica" class="img-fluid">
            </div>
        </div>

        <!-- CARD 5 -->
        <div class="card-item">
            <div class="card-text">
                <h2 class="card-title">Empregos.com.br</h2>
                <ul>
                    <li>Grande variedade de vagas em todo o Brasil.</li>
                    <li>Atualizações diárias e oportunidades reais.</li>
                    <li>Ambiente seguro para cadastro de currículo.</li>
                    <li>Clique e encontre sua vaga! </li>
                </ul>
                <a href="https://querobolsa.com.br/teste-vocacional-gratis?utm_source=" target="_blank"> <button class="btn-primary">Vagas</button href="../View/Curriculo.php"> </a>
            </div>
            <div class="card-image">
                <img src="../Img/página vagas/empregos.png" alt="Habilidades técnicas" class="img-fluid">
            </div>
        </div>

        <!-- CARD 6 -->
        <div class="card-item reverse">
            <div class="card-text">
                <h2 class="card-title">Trabalha Brasil</h2>
                <ul>
                    <li>Plataforma gratuita e fácil de usar.</li>
                    <li>Vagas em diversas cidades e setores.</li>
                    <li>Permite acompanhar candidaturas em tempo real.</li>
                    <li>Clique e encontre sua vaga!</li>
                </ul>
                <a href="https://querobolsa.com.br/teste-vocacional-gratis?utm_source=" target="_blank"> <button class="btn-primary">Vagas</button href="../View/Curriculo.php"> </a>
            </div>
            <div class="card-image">
                <img src="../Img/página vagas/trabalho brasil.png" alt="Revisão final" class="img-fluid">
            </div>
        </div>

            <!-- CARD 7 -->
        <div class="card-item">
            <div class="card-text">
                <h2 class="card-title">Glassdoor</h2>
                <ul>
                    <li>Veja avaliações e salários de empresas reais.</li>
                    <li>Compare oportunidades antes de se candidatar.</li>
                    <li>Transparência para escolher onde trabalhar.</li>
                    <li>Clique e encontre sua vaga!</li>
                </ul>
                <a href="https://querobolsa.com.br/teste-vocacional-gratis?utm_source=" target="_blank"> <button class="btn-primary">Vagas</button href="../View/Curriculo.php"> </a>
            </div>
            <div class="card-image">
                <img src="../Img/página vagas/glassdoor.png" alt="Revisão final" class="img-fluid">
            </div>
        </div>
    </section>
    <!-- Footer -->
 <!-- Footer Section -->
        <footer class="footer">
           
            <div class="footer-links">
                  <p class="footer-text">
                © 2025 Reintegra. Todos os direitos reservados.
            </p>
                <a href="#" class="footer-link">Política de Privacidade</a>
                <a href="#" class="footer-link">Termos de Serviço</a>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JS -->
    <script src="../Templates/js/vagas.js"></script>
</body>
</html>
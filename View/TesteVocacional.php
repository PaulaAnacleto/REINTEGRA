<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Vocacional Interativo | REINTEGRA</title>
        <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Templates/css/teste-vocacional.css">
</head>
<body>
    <div id="app">
        <!-- Página Inicial -->
        <div id="home-page" class="page active">
            <header class="header">
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">
      <div class="logo-box">
        <span class="logo-text">REINTEGRA</span>
        <a href="index.php"></a>
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
            <button class="btn-perfil">
              <img src="../Img/página de perfil/icone perfil.png" class="img-perfil" alt="Perfil">
            </button>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
            </header>

            <main class="main-content">
                <button class="back-button" aria-label="Voltar">
                    <img src="../Img/página de contato/seta.png" alt="Voltar" class="back-icon">
                </button>
                <div class="container">
                    <div class="card hero-card">
                        <div class="hero-section">
                            <h2>Qual é sua vocação?</h2>
                            <p>Responda a 13 perguntas simples e descubra as carreiras que mais se alinham aos seus interesses e talentos.</p>
                        </div>

                        <div class="features-grid">
                            <div class="feature-card">
                                <div class="feature-icon">⏱️</div>
                                <h3>5 minutos</h3>
                                <p>Teste rápido e objetivo</p>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon">🎯</div>
                                <h3>Preciso</h3>
                                <p>Resultado personalizado</p>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon">🚀</div>
                                <h3>Gratuito</h3>
                                <p>Sem custos ou cadastro</p>
                            </div>
                        </div>

                        <button class="btn btn-primary" onclick="iniciarTeste()">Começar Teste Agora</button>

                        <div class="info-box">
                            <p>💡 <strong>Dica:</strong> Responda com sinceridade para obter resultados mais precisos.</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Página do Teste -->
        <div id="test-page" class="page">
            <header class="header">
                <div class="container">
                    <div class="header-content">
                        <h1>Teste Vocacional</h1>
                        <div class="progress-info">
                            <span id="question-counter">Pergunta 1 de 15</span>
                        </div>
                    </div>
                    <div class="progress-bar">
                        <div id="progress-fill" class="progress-fill"></div>
                    </div>
                </div>
            </header>

            <main class="main-content">
                <div class="container">
                    <div class="card test-card">
                        <div id="question-container">
                            <h2 id="question-text"></h2>
                            <div class="question-line"></div>
                            <div id="answers-container" class="answers-grid"></div>
                        </div>

                        <div class="navigation">
                            <button class="btn btn-outline" id="btn-previous" onclick="perguntaAnterior()" disabled>← Anterior</button>
                            <span id="question-display">1 / 15</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Página de Resultados -->
        <div id="results-page" class="page">
            <header class="header">
                <div class="container">
                    <button class="btn-back" onclick="voltarHome()">← Voltar</button>
                    <h1>Seus Resultados</h1>
                </div>
            </header>

            <main class="main-content">
                <div class="container">
                    <!-- Resultado Principal -->
                    <div class="top-result-card">
                        <div class="result-header">
                            <span class="award-icon">🏆</span>
                            <h2>Sua Área Principal</h2>
                        </div>
                        <div class="result-content">
                            <h3 id="top-area-name"></h3>
                            <p id="top-area-description"></p>
                        </div>
                    </div>

                    <!-- Gráfico de Pontuação -->
                    <div class="card chart-card">
                        <h3>Distribuição de Pontuação</h3>
                        <div id="chart-container" class="chart-container"></div>
                    </div>

                    <!-- Dica da IA (Gemini) -->
                    <div id="ia-dica-container" class="card ia-dica">
                        <h3>💬 Dica Personalizada da IA</h3>
                        <div id="ia-dica-text">
                            <p>Gerando sua dica personalizada...</p>
                        </div>
                    </div>

                    <!-- Top 3 Áreas -->
                    <div class="card">
                        <h3>Suas 3 Melhores Áreas</h3>
                        <div id="top-areas-container" class="areas-grid"></div>
                    </div>

                    <!-- Carreiras Recomendadas -->
                    <div class="card">
                        <h3>Carreiras Recomendadas</h3>
                        <div id="careers-container" class="careers-grid"></div>
                    </div>

                    <!-- CTA Final -->
                    <div class="card cta-card">
                        <h3>Próximos Passos</h3>
                        <p>Pesquise mais sobre essas carreiras, converse com profissionais da área e explore oportunidades de estágio ou cursos relacionados.</p>
                        <div class="cta-buttons">
                            <button class="btn btn-primary" onclick="fazerTesteNovamente()">Fazer Teste Novamente</button>
                            <button class="btn btn-outline" onclick="voltarHome()">Voltar ao Início</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

        <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Script principal -->
    <script src="../Templates/js/teste-vocacional.js"></script>
</body>
</html>
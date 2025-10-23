<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrevista - Reintegra</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../Templates/css/Entrevista.css">
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

    <!-- Botão Voltar -->
    <button class="back-button" aria-label="Voltar">
        <img src="../Img/página de contato/seta.png" alt="Voltar" class="back-icon">
    </button>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <h1 class="hero-title">ENTREVISTA DE EMPREGO</h1>
        <p class="hero-description">
            Seja você <span class="highlight">iniciante</span> ou já com uma boa bagagem, aqui é o espaço ideal
            para mostrar <span class="highlight">quem</span> você é <span class="highlight">profissionalmente</span>.
        </p>
    </section>

    <!-- Component: Card Section -->
    <section class="content-section">

        <!-- CARD 1 -->
        <div class="card-item">
            <div class="card-text">
                <h2 class="card-title">Como se preparar antes da entrevista</h2>
                <ul>
                    <li>Pesquise sobre a empresa <br> Entenda o que ela faz, seus valores, cultura e projetos atuais.</li>
                    <li>Revise a vaga <br> Leia com atenção os requisitos e pense em como suas experiências se conectam com o que estão buscando.</li>
                    <li>Treine sua apresentação <br> Prepare um resumo breve sobre você, suas experiências e objetivos.</li>
                    <li>Organize documentos e currículo <br> Deixe tudo pronto e, se for presencial, leve cópias impressas.</li>
                    <li>Escolha a roupa adequada <br> Vista-se de forma alinhada com o ambiente da empresa, com cuidado e profissionalismo.</li>
                </ul>
            </div>
            <div class="card-image">
                <img src="../Img/página entrevista/Como se preparar antes da entrevista.png" alt="Como se preparar antes da entrevista" class="img-fluid">
            </div>
        </div>

        <!-- CARD 2 -->
        <div class="card-item reverse">
            <div class="card-text">
                <h2 class="card-title">Comportamento durante uma entrevista</h2>
                <ul>
                    <li>Seja pontual <br> Chegue com pelo menos 10 minutos de antecedência.</li>
                    <li>Seja educado e cordial <br> Cumprimente com um sorriso, mantenha uma postura profissional e olhe nos olhos (ou na câmera, se for online).</li>
                    <li>Escute com atenção <br> Espere o(a) entrevistador(a) terminar a pergunta antes de responder.</li>
                    <li>Responda com clareza e objetividade <br> Foque em exemplos concretos e evite respostas muito longas ou vagas.</li>
                </ul>
            </div>
            <div class="card-image">
                <img src="../Img/página entrevista/Comportamento durante uma entrevista.png" alt="Comportamento durante uma entrevista" class="img-fluid">
            </div>
        </div>

        <!-- CARD 3 -->
        <div class="card-item">
            <div class="card-text">
                <h2 class="card-title">Perguntas frequentes</h2>
                <ul>
                    <li>"Fale sobre você." <br> Dê um resumo profissional: formação, experiências e o que busca no momento.</li>
                    <li>"Quais são seus pontos fortes e fracos?" <br> Mostre autoconhecimento e equilíbrio. Traga um ponto fraco real, mas fale o que tem feito para melhorar.</li>
                    <li>"Por que quer trabalhar aqui?" <br> Conecte seus valores e objetivos com o que a empresa oferece.</li>
                    <li>"Onde se vê em 5 anos?" <br> Mostre ambição com realismo. Indique vontade de crescer e aprender.</li>
                    <li>"Por que saiu do último emprego?" <br> Seja honesto, mas evite críticas. Foque no que você busca de novo.</li>
                </ul>
            </div>
            <div class="card-image">
                <img src="../Img/página entrevista/perguntas frequentes.png" alt="Perguntas frequentes" class="img-fluid">
            </div>
        </div>

        <!-- CARD 4 -->
        <div class="card-item reverse">
            <div class="card-text">
                <h2 class="card-title">Após a Entrevista</h2>
                <ul>
                    <li>Agradeça o tempo e a oportunidade <br> Se puder, envie um e-mail curto de agradecimento no mesmo dia.</li>
                    <li>Reflita sobre a conversa <br> Pense no que foi bem e no que pode melhorar para as próximas vezes.</li>
                    <li>Aguarde o retorno com paciência <br> Respeite o prazo informado e, se passar muito tempo, é válido fazer um contato educado para saber o andamento.</li>
                    <li>Continue se preparando <br> Mesmo esperando uma resposta, siga buscando oportunidades e praticando.</li>
                </ul>
            </div>
            <div class="card-image">
                <img src="../Img/página entrevista/Após a Entrevista.png" alt="Ao final da entrevista" class="img-fluid">
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
    <script src="../Templates/js/curriculo.js"></script>
</body>
</html>
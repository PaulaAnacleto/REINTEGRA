<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currículo - Reintegra</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../Templates/css/curriculo.css">
</head>
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
        <h1 class="hero-title">CURRÍCULO PROFISSIONAL</h1>
        <p class="hero-description">
            Seja você <span class="highlight">iniciante</span> ou já com experiência, esse é o lugar pra organizar sua trajetória
            de forma clara e <span class="highlight">objetiva</span>.
        </p>
    </section>

    <!-- Component: Card Section -->
    <section class="content-section">

        <!-- CARD 1 -->
        <div class="card-item">
            <div class="card-text">
                <h2 class="card-title">Escolha um Formato Claro e Profissional</h2>
                <ul>
                    <li>Formato tradicional: Coloque as informações em tópicos e de maneira organizada.</li>
                    <li>Design simples: Evite excessos de cores e fontes. Mantenha uma aparência limpa e fácil de ler.</li>
                </ul>
            </div>
            <div class="card-image">
                <img src="../Img/página curriculo/Escolha um Formato Claro e Profissional.png" alt="Ilustração de currículo" class="img-fluid">
            </div>
        </div>

        <!-- CARD 2 -->
        <div class="card-item reverse">
            <div class="card-text">
                <h2 class="card-title">Informações de Contato</h2>
                <ul>
                    <li>Nome completo</li>
                    <li>Telefone</li>
                    <li>E-mail</li>
                    <li>LinkedIn</li>
                </ul>
            </div>
            <div class="card-image">
                <img src="../Img/página curriculo/Informações de Contato.png" alt="Informações de contato" class="img-fluid">
            </div>
        </div>

        <!-- CARD 3 -->
        <div class="card-item">
            <div class="card-text">
                <h2 class="card-title">Experiência Profissional</h2>
                <ul>
                    <li>Liste suas experiências de trabalho em ordem cronológica reversa.</li>
                    <li>Para cada cargo, inclua:</li>
                    <li>Nome da empresa e período de trabalho.</li>
                    <li>Descrição do cargo e principais responsabilidades.</li>
                    <li>Realizações: Cite resultados e conquistas específicas (como aumento de vendas, melhoria de processos, etc.).</li>
                </ul>
            </div>
            <div class="card-image">
                <img src="../Img/página curriculo/Experiência Profissional.png" alt="Experiência profissional" class="img-fluid">
            </div>
        </div>

        <!-- CARD 4 -->
        <div class="card-item reverse">
            <div class="card-text">
                <h2 class="card-title">Formação Acadêmica</h2>
                <ul>
                    <li>Inclua o nome da instituição, o curso e as datas de início e término.</li>
                    <li>Inclua especializações e cursos relevantes (idiomas, certificações, etc.).</li>
                </ul>
            </div>
            <div class="card-image">
                <img src="../Img/página curriculo/Formação Acadêmica.png" alt="Formação acadêmica" class="img-fluid">
            </div>
        </div>

        <!-- CARD 5 -->
        <div class="card-item">
            <div class="card-text">
                <h2 class="card-title">Habilidades Técnicas Relevantes</h2>
                <ul>
                    <li>Habilidades técnicas: como programação, design gráfico, gestão de projetos, etc.</li>
                    <li>Habilidades pessoais: comunicação, trabalho em equipe, liderança, entre outras.</li>
                </ul>
            </div>
            <div class="card-image">
                <img src="../Img/página curriculo/Habilidades técnicas relevantes.png" alt="Habilidades técnicas" class="img-fluid">
            </div>
        </div>

        <!-- CARD 6 -->
        <div class="card-item reverse">
            <div class="card-text">
                <h2 class="card-title">Revisão Final</h2>
                <ul>
                    <li>Revise o texto para evitar erros de gramática e digitação.</li>
                </ul>
            </div>
            <div class="card-image">
                <img src="../Img/página curriculo/Revisão final.png" alt="Revisão final" class="img-fluid">
            </div>
        </div>

        <h2 class="subtitle">CURRÍCULO PROFISSIONAL</h2>

            <!-- CARD 7 -->
        <div class="card-item">
            <div class="card-text">
                <h2 class="card-title">Idiomas</h2>
                <ul>
                    <li>Se for relevante para a vaga, adicione os idiomas que você domina, com o nível de proficiência (básico, intermediário, avançado, fluente).</li>
                </ul>
            </div>
            <div class="card-image">
                <img src="../Img/página curriculo/idiomas.png" alt="Revisão final" class="img-fluid">
            </div>
        </div>

            <!-- CARD 8 -->
        <div class="card-item reverse ">
            <div class="card-text">
                <h2 class="card-title">Resumo profissional</h2>
                <ul>
                    <li>Um parágrafo curto com seu perfil, experiência e objetivo.</li>
                </ul>
            </div>
            <div class="card-image">
                <img src="../Img/página curriculo/Resumo profissional.png" alt="Revisão final" class="img-fluid">
            </div>
        </div>

    <h2 class="subtitle">DICAS FINAIS</h2>

            <!-- CARD 9 -->
        <div class="card-item">
            <div class="card-text">
                <h2 class="card-title">Dicas</h2>
                <ul>
                    <li>Mantenha-o objetivo: Um currículo de uma página é geralmente suficiente, mas pode ser mais longo dependendo da sua experiência.</li>
                    <li>Atualize regularmente: Mesmo que não esteja procurando emprego, tenha seu currículo sempre atualizado.</li>
                </ul>
            </div>
            <div class="card-image">
                <img src="../Img/página curriculo/dicas.png" alt="Revisão final" class="img-fluid">
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

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Networking - Reintegra</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../Templates/css/Networking.css">
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

     <!-- Hero Section -->
    <section class="hero-section text-center">
        <!-- Botão Voltar -->
    <button class="back-button" aria-label="Voltar">
        <img src="../Img/página de contato/seta.png" alt="Voltar" class="back-icon">
    </button>
        <h1 class="hero-title">NETWORKING</h1>
        <p class="hero-description">
            Networking vai <span class="highlight">além</span> dos eventos presenciais. Hoje, apps são ferramentas <span class="highlight">poderosas</span> pra criar conexões, aprender e <span class="highlight">encontrar</span> oportunidades. Saiba como usá-los a seu favor!
        </p>
    </section>

        <section class="content-section">
            <div class="card-item">
                <div class="card-text">
                    <h2 class="card-title">Escolha o app ideal</h2>
                    <ul>
                        <li>LinkedIn: foco profissional e recrutamento.</li>
                        <li>Shapr: conexões por interesse.</li>
                        <li>Meetup: eventos e grupos por afinidade.</li>
                    </ul>
                </div>
                <div class="card-image">
                    <img src="../img/página de networking/Escolha o app ideal.png" alt="Ilustração de currículo" class="img-fluid">
                </div>
            </div>

            <div class="card-item reverse">
                <div class="card-text">
                    <h2 class="card-title">Monte um perfil que fale por você</h2>
                    <ul>
                        <li>Foto profissional: A primeira impressão conta! Use uma imagem de qualidade, com boa iluminação e que transmita profissionalismo</li>
                        <li>Resumo claro e objetivo: Seu resumo deve ser breve, mas destacar suas principais habilidades, experiências e interesses profissionais. Fale sobre quem você é, o que busca e como pode agregar valor.</li>
                        <li>Experiências e habilidades destacadas Mostre quem você é e o que tem a oferecer.</li>
                        
                    </ul>
                </div>
                <div class="card-image">
                    <img src="../img/página de networking/Monte um perfil que fale por você.png" alt="Ilustração de entrevista" class="img-fluid">
                </div>
            </div>

            <div class="card-item">
                <div class="card-text">
                    <h2 class="card-title">Conecte-se com propósito</h2>
                    <ul>
                        <li>Pesquise e escolha pessoas e empresas: Busque profissionais, empresas ou grupos que compartilhem interesses ou possam agregar ao seu crescimento.</li>
                        <li>Envie mensagens personalizadas: Ao enviar convites, sempre explique o motivo pelo qual deseja se conectar. Isso mostra seu interesse genuíno e aumenta as chances de aceitação.</li>
                        
                    </ul>
                   
                </div>
                <div class="card-image">
                    <img src="../img/página de networking/Conecte-se com propósito.png" alt="Ilustração de networking" class="img-fluid">
                </div>
            </div>

            <div class="card-item reverse">
                <div class="card-text">
                    <h2 class="card-title"> Cultive suas conexões</h2>
                    <ul>
                        <li>Interaja com suas conexões regularmente: Curta, comente e compartilhe conteúdos relevantes para se manter ativo nas plataformas.</li>
                        <li>Participe de grupos e eventos: Contribua com discussões e eventos online, isso ajuda a fortalecer sua rede.</li>
                        <li>Ofereça ajuda e compartilhe conhecimento: Networking não é só sobre o que você pode ganhar. Oferecer algo de valor, como insights ou dicas, fortalece seu vínculo com outros profissionais.</li>
                        
                    </ul>
                </div>
                <div class="card-image">
                    <img src="../img/página de networking/Cultive suas conexões.png" alt="Ilustração de entrevista" class="img-fluid">
                </div>
            </div>
            
        </section>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
           
           <div class="footer-links">
                 <p class="footer-text">
               © 2025 Reintegra. Todos os direitos reservados.
           </p>
               <a href="../View/Politica-Privacidade.php" class="footer-link">Política de Privacidade</a>
               <a href="../View/Termos-servico.php" class="footer-link">Termos de Serviço</a>
           </div>
       </footer>
   </div>

    <script src="../Templates/js/Networking.js"></script>
</body>
</html>
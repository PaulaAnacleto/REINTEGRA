<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Vocacional - Reintegra</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../Templates/css/vocacional.css">
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../view/Servicos">Serviços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#cadastro">Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../View/Contato.php">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sobre">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../View/Inicial-login.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a href="../View/Perfil.php">
                        <button class="btn-perfil" onclick="abrirPerfil()">
                            <img src="../Img/página de perfil/icone perfil.png" class="img-perfil" alt="Perfil">
                        </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

     <button class="back-button" aria-label="Voltar">
                <img src="../Img/página de contato/seta.png" alt="Voltar" class="back-icon">
            </button>

        <section class="hero-section">
       
            <h1 class="hero-title">TESTE VOCACIONAL</h1>
            <p class="hero-description">
                Descobrir sua área ideal de trabalho vai <span class="highlight"> além da intuição.</span> Hoje, testes vocacionais são
                <span class="highlight">ferramentas</span> poderosas para conhecer seus talentos, definir objetivos e traçar um <span class="highlight">caminho profissional</span> com mais clareza.
            </p>
            
            
        </section>

        <section class="content-section">
            

            <div class="card-item reverse">
                <div class="card-text">
                    <h2 class="card-title">Guia da Carreira</h2>
                    <ul>
                        Um teste simples baseado na teoria de John Holland (modelo RIASEC), que ajuda a descobrir que tipos de carreiras têm mais afinidade com seu perfil.
                    </ul>
                  <a href="https://www.guiadacarreira.com.br/teste-vocacional?utm_source=" target="_blank">  <button class="btn-primary">Testar</button> </a>
                </div>
                <div class="card-image">
                    <img src="../img/página tutoriais e dicas/guia da carreira.png" alt="Ilustração de entrevista" class="img-fluid">
                </div>
            </div>

            <div class="card-item">
                <div class="card-text">
                    <h2 class="card-title">Quero Bolsa</h2>
                    <ul>
                         
                   Baseado na teoria das Inteligências Múltiplas (Howard Gardner), analisa suas inteligências 
                        e habilidades para sugerir cursos e áreas de atuação com boa afinidade.
                        </ul>
                    <a href="https://querobolsa.com.br/teste-vocacional-gratis?utm_source=" target="_blank"> <button class="btn-primary">Testar</button href="../View/Curriculo.php"> </a>
                </div>
                <div class="card-image">
                    <img src="../img/página tutoriais e dicas/quero bolsa.png" alt="Ilustração de currículo" class="img-fluid">
                </div>
            </div>


            <div class="card-item reverse">
                <div class="card-text">
                    <h2 class="card-title">Descomplica</h2>
                    <ul>
                        Gratuito, rápido, baseado no modelo RIASEC. Ajuda a identificar seu perfil profissional 
                        (Realista, Investigativo, etc) e mostra caminhos de carreira que combinam com você.
                    </ul>
                  <a href="https://descomplica.com.br/faculdade/teste-vocacional/?utm_source=" target="_blank">   <button class="btn-primary">Testar</button> </a>
                </div>
                <div class="card-image">
                    <img src="../img/página tutoriais e dicas/descomplica.png" alt="Ilustração de networking" class="img-fluid">
                </div>
            </div>

            <div class="card-item">
                <div class="card-text">
                    <h2 class="card-title">123test</h2>
                    <ul>
                         
                   Um teste internacional em inglês/português que usa forte base científica para
                    sugerir profissões e ambientes de trabalho compatíveis com sua personalidade e interesses.
                        </ul>
                    <a href="https://www.123test.com/pt/teste-vocacional/" target="_blank">   <button class="btn-primary">Testar</button href="../View/Curriculo.php"> </a>
                </div>
                <div class="card-image">
                    <img src="../img/página tutoriais e dicas/123test.png" alt="Ilustração de currículo" class="img-fluid">
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

    <script src="../Templates/js/vocacional.js"></script>
</body>
</html>
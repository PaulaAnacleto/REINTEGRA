<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutoriais e Dicas - Reintegra</title>

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <link rel="stylesheet" href="../Templates/css/Tutoriais-dicas.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <!-- <a class="navbar-brand" href="#"> -->
        <div class="navbar-left">
            <div class="logo-box">
                <span class="logo-text">REINTEGRA</span>
            </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="navbar-right">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#serviços">Serviços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contato">Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contato">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sobre">Sobre</a>
                    </li>
                    <li   class="nav-item">
                     <a class="nav-link" href="#inicio">Início</a> 
                    </li>
                </ul>
            </div>
            <li class="nav-item-img" style="list-style-type: none;">
                <img src="../Img/página de perfil/icone perfil.png" class="img-perfil" alt="Perfil">
            </li>
        </div>
    </div>
</nav>

    <div class="container">
        <section class="hero-section">
        <button class="back-button" aria-label="Voltar">
                <img src="../Img/página de contato/seta.png" alt="Voltar" class="back-icon">
            </button>
            <h1 class="hero-title">TUTORIAIS E DICAS</h1>
            <p class="hero-description">
                Descubra conteúdos práticos e <span class="highlight">objetivos</span> que vão te ajudar a
                <span class="highlight">aprender</span>, evoluir e encarar cada desafio com mais <span class="highlight">confiança</span>.
            </p>
            
            
        </section>

        <section class="content-section">
            <div class="card-item">
                <div class="card-text">
                    <h2 class="card-title">Monte seu Currículo</h2>
                    <ul>
                        <li>Como criar um currículo profissional</li>
                        <li>Passo a passo para montar um currículo perfeito</li>
                        <li>Aprenda a fazer um currículo de sucesso</li>
                        <li>Dicas essenciais para criar um currículo profissional</li>
                    </ul>
                    <button class="btn-primary">Começar</button href="../View/Curriculo.php">
                </div>
                <div class="card-image">
                    <img src="../img/página tutoriais e dicas/monte seu curriculo.png" alt="Ilustração de currículo" class="img-fluid">
                </div>
            </div>

            <div class="card-item reverse">
                <div class="card-text">
                    <h2 class="card-title">Domine a Entrevista</h2>
                    <ul>
                        <li>Como se preparar antes da entrevista</li>
                        <li>Aprenda como se comportar durante uma entrevista</li>
                        <li>Perguntas Frequentes</li>
                        <li>Após a Entrevista</li>
                    </ul>
                    <button class="btn-primary">Começar</button>
                </div>
                <div class="card-image">
                    <img src="../img/página tutoriais e dicas/domine a entrevista.png" alt="Ilustração de entrevista" class="img-fluid">
                </div>
            </div>

            <div class="card-item">
                <div class="card-text">
                    <h2 class="card-title">Aproveitando o Poder do Networking</h2>
                    <ul>
                        <li>Escolha os aplicativos certos para seu objetivo</li>
                        <li>Monte um perfil que fale por você</li>
                        <li>Conecte-se com propósito</li>
                        <li>Cultive suas conexões</li>
                    </ul>
                    <button class="btn-primary">Começar</button>
                </div>
                <div class="card-image">
                    <img src="../img/página tutoriais e dicas/Aproveitando o poder do networking.png" alt="Ilustração de networking" class="img-fluid">
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

    <script src="../Templates/js/Tutoriais-dicas.js"></script>
</body>
</html>
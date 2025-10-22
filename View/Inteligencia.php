<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Inteligência Emocional e Pessoal</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="../Templates/css/Inteligencia.css">
</head>
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

<!-- Header -->
<header class="header">
    <div class="btn-retorno">
        <button class="back-button" aria-label="Voltar">
            <img src="../Img/página de contato/seta.png" alt="Voltar" class="back-icon">
        </button>
    </div>
</header>


<body>
    <div class="inicio">
        <div class="inicio-inner">
            <div class="texto-inicio">
                <h1 class="title"> Inteligência Emocional e <span>Pessoal</span></h1>
                <p class="paragrafo">Oferecemos um curso <span>completo</span> de Inteligência <span>Emocional</span> e Pessoal, <br> 
                focado em <span>desenvolver</span> habilidades <span>essenciais</span> para o autoconhecimento, <br>
                gestão emocional e relacionamento interpessoal.
                   
                    
                </p>
            </div>
        </div>
        <div class="image">
            <img src="../Img/Inteligencia_emocional/Inteligencia_emocional.png" alt="Ciclo inovaçao" class="hero-img">
        </div>
    </div>

    <hr>
    <div class="texto-motivador">
        <h2>Invista no seu <span>conhecimento</span></h2>
</div>

    <main class="conteudo">
        
        <div class="card">
            <div class="card-header">
            <img src="../Img/Inteligencia_emocional/Controle.png" alt="Engrenagens" class="icone">
            <h3>Técnicas de controle</h3>
            </div>
            <p class="text-card">Autocontrole, Gestão de estresse e <span>entre outros...</span></p>
        </div>

        <div class="card">
              <div class="card-header">
            <img src="../Img/Inteligencia_emocional/Comunicacao.png" alt="PPessoas com lâmpada em cima" class="icone">
            <h3>Comunicação não violenta</h3>
        </div>
            <p class="text-card">Escuta ativa, Empatia, Resolução de conflitos e <span>entre outros...</span></p>
        </div>

        <div class="card">
              <div class="card-header">
            <img src="../Img/Inteligencia_emocional/Autoconhecimento.png" alt="xadrez com ideias" class="icone">
            <h3>Ferramentas de autoconhecimento.</h3>
        </div>
            <p class="text-card">Journaling, Meditação e <span>entre outros...</span></p>
        </div>



        <div class="logo-senai">
            <h4 class="parceria">Parceria</h4>
            <img src="../Img/página inicial/logo_senai.png" alt="Título da parceria com a logo da empresa SENAI" class="img-logo">
        </div>
    </main>





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

</body>

</html>
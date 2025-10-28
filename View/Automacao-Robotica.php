<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automação e Robótica</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="../Templates/css/automacao-robotica.css">
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
    
    <div vw class="enabled">
  <div vw-access-button class="active"></div>
  <div vw-plugin-wrapper>
    <div class="vw-plugin-top-wrapper"></div>
  </div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
  new window.VLibras.Widget('https://vlibras.gov.br/app' );
</script>]


    <div class="inicio">
        <div class="inicio-inner">
            <div class="texto-inicio">
                <h1 class="title">Automação e <span>Robótica</span></h1>
                <p class="paragrafo">Oferecemos um curso <span>completo</span> de Automação
                    e Robótica, voltado para <br>quem <span>deseja</span> ingressar ou se
                    atualizar em uma das <span>áreas</span> mais <span>promissoras</span> da tecnologia.
                </p>
            </div>
        </div>
        <div class="image">
            <img src="../Img/páginas dos cursos/automação e robótica.png" alt="Braço mecânico" class="hero-img">
        </div>
    </div>

    <hr>
    <div class="texto-motivador">
        <h2>Invista no seu <span>conhecimento</span></h2>
</div>

    <main class="conteudo">
        
        <div class="card">
            <div class="card-header">
            <img src="../Img/páginas dos cursos/automacao.png" alt="Engrenagens" class="icone">
            <h3>Automação</h3>
            </div>
            <p class="text-card">Programação, CLPs, sensores, atuadores e <span>entre outros...</span></p>
        </div>

        <div class="card">
              <div class="card-header">
            <img src="../Img/páginas dos cursos/robotica.png" alt="Mão de um robô" class="icone">
            <h3>Robótica</h3>
        </div>
            <p class="text-card">Projeto, robôs, atuadores, controle e <span>entre outros...</span></p>
        </div>

        <div class="card">
              <div class="card-header">
            <img src="../Img/páginas dos cursos/inteligencia-artificial.png" alt="Nuvem tecnológica" class="icone">
            <h3>Inteligência artificial</h3>
        </div>
            <p class="text-card">Algoritmos, dados, redes neurais e <span>entre outros...</span></p>
        </div>

        <div class="card">
              <div class="card-header">
            <img src="../Img/páginas dos cursos/sensores.png" alt="Sensor" class="icone">
            <h3>Sensores</h3>
            </div>
            <p class="text-card">Detecção, medição, pressão e <span>entre outros...</span></p>
        </div>

        <div class="card">
            <div class="card-header">
            <img src="../Img/páginas dos cursos/manufatura.png" alt="Lâmpada com engrenagem" class="icone">
            <h3>Manufatura inteligente</h3>
            </div>
            <p class="text-card">IoT, otimização, produção, eficiência e <span>entre outros...</span></p>
        </div>

        <div class="card">
            <div class="card-header">
            <img src="../Img/páginas dos cursos/industria.png" alt="Indústria" class="icone">
            <h3>Industria 4.0</h3>
            </div>
            <p class="text-card">Ciberfísico, integração, análise em tempo real e <span>entre outros...</span></p>
        </div>

        <div class="card">
              <div class="card-header">
            <img src="../Img/páginas dos cursos/integracao.png" alt="Duas engrenagens em um ciclo" class="icone">
            <h3>Integração de Máquinas</h3>
            </div>
            <p class="text-card">Comunicação, sincronização, redes industriais e <span>entre outros...</span></p>
        </div>

        <div class="logo-senai">
            <h4 class="parceria">Parceria</h4>
            <img src="../Img/página inicial/logo senai.png" alt="Título da parceria com a logo da empresa SENAI" class="img-logo">
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
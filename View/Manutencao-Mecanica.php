<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenção e Engenharia Mecânica</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="../Templates/css/manutencao-mecanica.css">
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
</script>

    <div class="inicio">
        <div class="inicio-inner">
            <div class="texto-inicio">
                <h1 class="title">Manutenção e Engenharia <span>Mecânica</span></h1>
                <p class="paragrafo">Oferecemos um curso <span>completo</span> de Engenharia Mecânica e 
                Manutenção Industrial,<br> <span>ideal</span> pra quem quer entrar com tudo ou se <span>atualizar</span> em duas áreas 
                <span>essenciais</span> da indústria.
                </p>
            </div>
        </div>
        <div class="image">
            <img src="../Img/páginas dos cursos/Manutenção e Engenharia Mecânica.png" alt="Engrenagem azul" class="hero-img">
        </div>
    </div>

    <hr>
    <div class="texto-motivador">
        <h2>Invista no seu <span>conhecimento</span></h2>
</div>

    <main class="conteudo">
        
        <div class="card">
            <div class="card-header">
            <img src="../Img/páginas dos cursos/manutencao-industrial.png" alt="Capacete de segurança e duas engrenagens juntas" class="icone">
            <h3>Manutenção Industrial</h3>
            </div>
            <p class="text-card">Inspeção, prevenção, correção, diagnóstico e <span>entre outros...</span></p>
        </div>

        <div class="card">
              <div class="card-header">
            <img src="../Img/páginas dos cursos/engenharia-manutencao.png" alt="Engrenagem com uma chave inglesa em seu centro" class="icone">
            <h3>Engenharia de Manutenção</h3>
        </div>
            <p class="text-card">Otimização, prevenção, análise e <span>entre outros...</span></p>
        </div>

        <div class="card">
              <div class="card-header">
            <img src="../Img/páginas dos cursos/manutencao-preventiva.png" alt="Homem com um capacete de segurança e uma prancheta" class="icone">
            <h3>Manutenção Preventiva</h3>
        </div>
            <p class="text-card">Falhas, conservação, eficiência e <span>entre outros...</span></p>
        </div>

        <div class="card">
              <div class="card-header">
            <img src="../Img/páginas dos cursos/manutencao-preditiva.png" alt="Um circulo com uma chave de fenda e embaixo dela uma chave inglesa em seu centro, ao seu redor ícones que representam comunicação e organização" class="icone">
            <h3>Manutenção Preditiva</h3>
            </div>
            <p class="text-card">Desempenho, otimização, confiabilidade e <span>entre outros...</span></p>
        </div>

        <div class="card">
            <div class="card-header">
            <img src="../Img/páginas dos cursos/engenharia-mecanica.png" alt="Engrenagem" class="icone">
            <h3>Engenharia Mecânica</h3>
            </div>
            <p class="text-card">Projeto, análise, materiais, resistência e <span>entre outros...</span></p>
        </div>

        <div class="card">
            <div class="card-header">
            <img src="../Img/páginas dos cursos/projetos-mecanicos.png" alt="Engrenagem e roda" class="icone">
            <h3>Projetos Mecânicos</h3>
            </div>
            <p class="text-card">Desenho, modelagem, CAD e <span>entre outros...</span></p>
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
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="../Templates/css/cursos.css">
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
                        <a class="nav-link" href="../View/Inicial-login.php">Feedback</a>
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

        <h1 class="title">Confira os <span>cursos disponíveis</span></h1>
        <p class="paragrafo">Invista no seu futuro profissional,
            explore nossos cursos e aperfeiçoe suas
            habilidades para alcançar <span>novas oportunidades </span>
            no mercado de trabalho!
        </p>
    </div>

    <main class="conteudo">
        <div class="card">
            <h3>Automação e Róbotica</h3>
            <p class="text-card">Automação, Robótica, Inteligência Artificial, Sensores,
                Manufatura Inteligente, Indústria 4.0,
                Integração de Máquinas.</p>
        </div>

        <div class="card">
            <h3>Manutenção e Engenharia Mecânica</h3>
            <p class="text-card">Manutenção Industrial, Engenharia
                de Manutenção, Manutenção Preventiva,
                Manutenção Preditiva, Engenharia Mecânica, Projetos Mecânicos.</p>
        </div>

        <div class="card">
            <h3>Segurança do Trabalho</h3>
            <p class="text-card">Normas Regulamentadoras (NRs),
                Análise de Riscos, CIPA, Equipamentos de Proteção Individual
                (EPIs), Gestão de Saúde e Segurança, Prevenção de Acidentes.</p>
        </div>

        <div class="card">
            <h3>Empreendedorismo e Inovação</h3>
            <p class="text-card">Modelos de Negócios, Startups,
                Planejamento Estratégico, Gestão de Inovação, Marketing Digital,
                Design Thinking, Análise de Mercado.</p>
        </div>

        <div class="card">
            <h3>Inteligência Emocional e Pessoal</h3>
            <p class="text-card">Técnicas de controle de estresse no ambiente
                de trabalho, Comunicação não violenta e Ferramentas de
                autoconhecimento.</p>
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
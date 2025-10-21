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
            <h1 class="hero-title">CURRÍCULO PROFISSIONAL</h1>
            <p class="hero-description">
                Seja você <span class="highlight">iniciante</span> ou já com experiência, esse é o lugar pra organizar sua trajetória
                de forma clara e <span class="highlight">objetiva </span>.
            </p> 
        </section>

        <section class="content-section">
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
                    <img src="../Img/página curriculo/Informações de Contato.png" alt="Ilustração de entrevista" class="img-fluid">
                </div>
            </div>

            <div class="card-item">
                <div class="card-text">
                    <h2 class="card-title">Experiência Profissional</h2>
                    <ul>
                        <li>Liste suas experiências de trabalho em ordem cronológica reversa</li>
                        <li>Para cada cargo, inclua:</li>
                        <li>Nome da empresa e período de trabalho.</li>
                        <li>Descrição do cargo e principais responsabilidades.</li>
                        <li>Realizações: Cite resultados e conquistas específicas (como aumento de vendas, melhoria de processos, etc.). </li>
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

    <script src="../Templates/js/curriculo.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reintegra - Reintegrando sua vida por completo</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="Templates/css/index.css">
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
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#ser">Serviços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="View/Contato.php">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sobre">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="View/Login.php">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white px-4 ms-2" href="View/Cadastro.php">Cadastre-se</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="inicio" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="hero-title">Reintegrando sua vida por completo</h1>
                    <p class="hero-text">Dedicamos no fortalecimento do mercado de trabalho e oportunidades para ex-trabalhadores da Ford e operadores</p>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-container">
                        <img src="Img/página inicial/imagem da casa.png" alt="Casa com painéis solares" class="img-fluid hero-image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Parceria Section -->
    <section class="parceria-section">
        <div class="container text-center">
            <h3 class="parceria-title mb-4">Parceria</h3>
            <img src="Img/página inicial/logo senai.png" alt="Logo SENAI" class="img-fluid senai-logo">
        </div>
    </section>

    <!-- Sobre o Reintegra Section -->
    <section id="sobre" class="sobre-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="section-title mb-4">Sobre o Reintegra</h2>
                    <p class="section-text mb-4">Focamos no fortalecimento do mercado de trabalho e oportunidades profissionais para ex-trabalhadores da Ford e operadores, em função da necessidade de informações sobre a nova modelagem do mercado de trabalho de Camaçari após a saída da empresa (Ford). Bem como, a abertura para novas possibilidades em outras áreas profissionais, através de cursos e aulas, a fim de mitigar os desafios de adaptabilidade enfrentado por estes trabalhadores.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="feature-item feature-purple">
                                <div class="feature-icon-box feature-icon-purple">
                                    <img src="Img/página inicial/icone objetivo.png" alt="Ícone Objetivo" class="feature-icon">
                                </div>
                                <h6 class="feature-title">Objetivo</h6>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="feature-item feature-orange">
                                <div class="feature-icon-box feature-icon-orange">
                                    <img src="Img/página inicial/icone fidelidade.png" alt="Ícone Fidelidade" class="feature-icon">
                                </div>
                                <h6 class="feature-title">Fidelidade</h6>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="feature-item feature-green">
                                <div class="feature-icon-box feature-icon-green">
                                    <img src="Img/página inicial/icone qualidade.png" alt="Ícone Qualidade" class="feature-icon">
                                </div>
                                <h6 class="feature-title">Qualidade</h6>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="feature-item feature-red">
                                <div class="feature-icon-box feature-icon-red">
                                    <img src="Img/página inicial/icone inovacao.png" alt="Ícone Inovação" class="feature-icon">
                                </div>
                                <h6 class="feature-title">Inovação</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="sobre-image-container">
                        <div class="sobre-image-wrapper">
                            <img src="Img/página inicial/sobre nós.png" alt="Pessoa de camisa laranja" class="img-fluid sobre-image">
                            <div class="badge-seguro">
                                <span>✓ 100% Seguro</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Entre em Contato Section -->
    <section id="contato" class="contato-section">
        <div class="contato-waves"></div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="contato-title">Entre em contato</h2>
                    <p class="contato-text mb-4">Tem dúvidas ou precisa de mais informações? Estamos aqui para ajudar! Entre em contato conosco e responderemos o mais rápido possível.</p>
                    <button class="btn btn-contato" type="button" onclick="window.location.href='#contato'">Contato</button>
                </div>
                <div class="col-lg-6 text-end">
                    <div class="contato-image-container">
                        <img src="Img/página inicial/mulher - entre em contato.png" alt="Mulher com laptop" class="img-fluid contato-image">
                        <div class="contato-waves-decoration">
                            <svg width="80" height="60" viewBox="0 0 80 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 30 Q 15 20, 25 30 T 45 30 T 65 30 T 85 30" stroke="white" stroke-width="3" fill="none" opacity="0.6"/>
                                <path d="M5 40 Q 15 30, 25 40 T 45 40 T 65 40 T 85 40" stroke="white" stroke-width="3" fill="none" opacity="0.6"/>
                                <path d="M5 50 Q 15 40, 25 50 T 45 50 T 65 50 T 85 50" stroke="white" stroke-width="3" fill="none" opacity="0.6"/>
                            </svg>
                        </div>
                        <div class="star-decoration contato-star-1">✦</div>
                        <div class="star-decoration contato-star-2">✦</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feedbacks Section -->
    <section id="feedbacks" class="feedbacks-section">
        <div class="container">
            <h2 class="section-title text-center mb-3">Feedbacks</h2>
            <p class="text-center text-muted mb-5">Veja o que dizem aqueles que já se inscreveram no Reintegra e tiveram suas vidas transformadas!</p>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="feedback-card">
                        <div class="feedback-content">
                            <div class="feedback-avatar-wrapper feedback-avatar-pink">
                                <img src="Img/página inicial/mariana santos.png" alt="Mariana Santos" class="feedback-avatar">
                            </div>
                            <p class="feedback-text">"Após me inscrever no Reintegra, consegui uma oportunidade de emprego que mudou minha vida. Sou muito grata!"</p>
                            <h6 class="feedback-name">Mariana Santos</h6>
                            <p>Supervisora</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="feedback-card">
                        <div class="feedback-content">
                            <div class="feedback-avatar-wrapper feedback-avatar-blue">
                                <img src="Img/página inicial/josé carlos.png" alt="José Carlos" class="feedback-avatar">
                            </div>
                            <p class="feedback-text">"Graças ao curso que fiz, consegui me reintegrar ao mercado de trabalho e hoje tenho uma vida digna."</p>
                            <h6 class="feedback-name">José Carlos</h6>
                            <p>Técnico de Manutenção</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="feedback-card">
                        <div class="feedback-content">
                            <div class="feedback-avatar-wrapper feedback-avatar-red">
                                <img src="Img/página inicial/carlos martins.png" alt="Carlos Martins" class="feedback-avatar">
                            </div>
                            <p class="feedback-text">"O Reintegra me deu uma segunda chance. Hoje trabalho com dignidade e tenho orgulho da minha trajetória."</p>
                            <h6 class="feedback-name">Carlos Martins</h6>
                            <p>Operador de Produção</p>
                        </div>
                    </div>
                </div>
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
                <a href="View/Politica-privacidade.php" class="footer-link">Política de Privacidade</a>
                <a href="View/termos-servico.php" class="footer-link">Termos de Serviço</a>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="/Templates/js/index.js"></script>
</body>
</html>
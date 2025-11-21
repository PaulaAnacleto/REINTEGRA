<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>
    <link rel="stylesheet" href="../Templates/css/contato.css">
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

    <div class="container">
        <!-- Header -->
        <header class="header">
            <button class="back-button" aria-label="Voltar">
                <img src="../Img/página de contato/seta.png" alt="Voltar" class="back-icon">
            </button>
            <h1 class="title">
                Como prefere <span class="highlight">falar com a gente?</span>
            </h1>
        </header>

        <!-- opções de contato -->
        <section class="contact-section">
            <div class="contact-card">
                <div class="icon-wrapper">
                    <img src="../Img/página de contato/icone email.png" alt="E-mail" class="contact-icon">
                </div>
                <h2 class="contact-title">E-mail</h2>
                <a href="mailto:reintegracontato@gmail.com" class="contact-link">
                    reintegracontato@gmail.com
                </a>
            </div>

            <div class="contact-card">
                <div class="icon-wrapper">
                    <img src="../Img/página de contato/icone telefone.png" alt="Telefone" class="contact-icon">
                </div>
                <h2 class="contact-title">Telefone</h2>
                <a href="tel:08007866890" class="contact-link">
                    0800 786 6890
                </a>
            </div>

            <div class="contact-card">
                <div class="icon-wrapper">
                    <img src="../Img/página de contato/icone whatsapp.png" alt="WhatsApp" class="contact-icon">
                </div>
                <h2 class="contact-title">Whatsapp</h2>
                <a href="https://wa.me/5571993105092" class="contact-link">
                    71 99310-5092
                </a>
            </div>
        </section>

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
    
    <script src="../Templates/js/contato.js"></script>
</body>
</html>

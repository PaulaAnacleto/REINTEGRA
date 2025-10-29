<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - REINTEGRA</title>
    <link rel="stylesheet" href="../Templates/css/login.css">
</head>
<body>]


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
        <!-- Seção esquerda com branding -->
        <div class="left-section">
            <div class="brand-content">
                <h1 class="brand-title">REINTEGRA</h1>
                <p class="brand-subtitle">Encontre seu emprego dos sonhos!</p>
                <a href="../View/index.php">
                <button class="learn-more-btn">Saiba mais</button>
            </div>
            </a>
            <div class="decorative-circle"></div>
        </div>

        <!-- Seção direita com formulário -->
        <div class="right-section">
            <div class="form-container">
                <h2 class="form-title">Entrar</h2>
                <p class="form-subtitle">Não tem uma conta? <a href="../View/Cadastro.php" class="signup-link">Cadastre-se</a></p>
                
                <form id="loginForm" class="login-form">
                    <div class="input-group">
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="error-message"></div>
                    </div>

                    <div class="input-group">
                        <div class="input-wrapper">
                            <input type="password" id="senha" name="senha" placeholder="Senha" required>
                        </div>
                        <div class="error-message"></div>
                    </div>

                    <button type="submit" class="submit-btn">Entrar</button>
                    
                    <div class="forgot-password">
                        <a href="#" class="forgot-link">Esqueceu a senha?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../Templates/js/login.js"></script>
</body>
</html>


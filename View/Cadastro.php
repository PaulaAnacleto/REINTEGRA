<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - REINTEGRA</title>
    <link rel="stylesheet" href="../Templates/css/cadastro.css">

</head>
<body>
    <div class="container">
        <!-- Seção esquerda com branding -->
        <div class="left-section">
            <div class="brand-content">
                <h1 class="brand-title">REINTEGRA</h1>
                <p class="brand-subtitle">Encontre seu emprego dos sonhos!</p>
                <a href="../View/index"><button class="learn-more-btn">Saiba mais</button> </a>
            </div>
            <div class="decorative-circle"></div>
        </div>

        <!-- Seção direita com formulário -->
        <div class="right-section">
            <div class="form-container">
                <h2 class="form-title">Cadastre-se</h2>
                <p class="form-subtitle">Cadastre-se para começar</p>
                
                <form id="cadastroForm" class="cadastro-form">
                    <div class="input-group">
                        <div class="input-wrapper">
                            <input type="text" id="nomeCompleto" name="nomeCompleto" placeholder="Nome Completo" required>
                        </div>
                         <div class="error-message"></div> <!-- Esta linha foi adicionada -->
                    </div>

                    <div class="input-group">
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email" placeholder="Email" required>
                        </div>
                         <div class="error-message"></div> <!-- Esta linha foi adicionada -->
                    </div>

                    <div class="input-group">
                        <div class="input-wrapper">
                            <input type="password" id="senha" name="senha" placeholder="Senha" required>
                        </div>
                         <div class="error-message"></div> <!-- Esta linha foi adicionada -->
                    </div>

                    <div class="input-group">
                        <div class="input-wrapper">
                            <input type="password" id="confirmarSenha" name="confirmarSenha" placeholder="Confirmar senha" required>
                        </div>
                         <div class="error-message"></div> <!-- Esta linha foi adicionada -->
                    </div>

                    <button type="submit" class="submit-btn">Cadastre-se</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../Templates/js/cadastro.js"></script>
</body>
</html>
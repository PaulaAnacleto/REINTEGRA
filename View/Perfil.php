<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - REINTEGRA</title>
    <link rel="stylesheet" href="../Templates/css/perfil.css">
</head>
<body>
    <div class="container">
        <!-- Header com informações do usuário -->
        <header class="profile-header">
            <div class="header-content">
                <h1 class="welcome-message">
                    Bem vindo(a), <span id="userName"></span>
                </h1>
            </div>
        </header>

        <!-- Conteúdo principal -->
        <main class="main-content">
            <div class="content-wrapper">
                <!-- Botão voltar -->
                <div class="navigation">
                    <button class="back-button" aria-label="Voltar">
                <img src="../Img/página de contato/seta.png" alt="Voltar" class="back-icon">
            </button>
                    <h2 class="page-title">PÁGINA DE PERFIL</h2>
                </div>

                <!-- Card do perfil -->
                <div class="profile-card">
                    <!-- Seção do avatar e informações básicas -->
                    <div class="profile-info">
                        <div class="avatar-section">
                            <div class="avatar">
                            <img src="../img/página de perfil/icone perfil.png" alt="">
                            </div>
                            <div class="user-details">
                                <h3 class="user-name" id="profileUserName">Nome de usuário</h3>
                                <p class="user-email" id="profileUserEmail">Email</p>
                            </div>
                        </div>
                    </div>

                    <!-- Formulário de dados do perfil -->
                    <form id="profileForm" class="profile-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nomeCompleto" class="form-label">Nome completo</label>
                                <input type="text" id="nomeCompleto" name="nomeCompleto" class="form-input" value="Nome" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-input" value="example@email.com" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="dataNascimento" class="form-label">Data de nascimento</label>
                                <input type="date" id="dataNascimento" name="dataNascimento" class="form-input" value="0000-00-00" readonly>
                            </div>
                            <div class="form-group">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" id="cpf" name="cpf" class="form-input" value="000.000.000-00" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="profissao" class="form-label">Profissão</label>
                                <input type="text" id="profissao" name="profissao" class="form-input" value="profissão" readonly>
                            </div>
                        </div>

                        <!-- Botões de ação -->
                        <div class="form-actions">
                            <button type="button" id="editBtn" class="action-btn edit-btn">

                                Editar Perfil
                            </button>
                            <button type="submit" id="saveBtn" class="action-btn save-btn" style="display: none;">
                             
                                Salvar Alterações
                            </button>
                            <button type="button" id="cancelBtn" class="action-btn cancel-btn" style="display: none;">
                               
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </main>
    </div>

     <!-- Footer Section -->
        <footer class="footer">
           
            <div class="footer-links">
                  <p class="footer-text">
                © 2025 Reintegra. Todos os direitos reservados.
            </p>
                <a href="../View/Politica-privacidade.php" class="footer-link">Política de Privacidade</a>
                <a href="../View/termos-servico.php" class="footer-link">Termos de Serviço</a>
            </div>
        </footer>
    </div>

    <script src="../Templates/js/perfil.js"></script>
</body>
</html>
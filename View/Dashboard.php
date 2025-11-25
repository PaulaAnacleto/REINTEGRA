<?php
// colaborador.php - Painel de Colaborador para Gerenciar Eventos e Cursos
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Colaborador - Reintegra</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Templates/css/Dashboard.css">
    
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
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    
    

    <!-- Main Content -->
    <div class="container-fluid colaborador-container">
        <div class="colaborador-content">
            <div class="colaborador-header">
                <h1 class="colaborador-title">Painel de Colaborador</h1>
                <p class="colaborador-subtitle">Gerencie eventos e cursos da plataforma Reintegra</p>
            </div>

            <div class="colaborador-cards-container">
                <!-- Card: Criar Eventos -->
                <div class="colaborador-card">
                    <div class="card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                            <line x1="12" y1="14" x2="12" y2="20"></line>
                            <line x1="9" y1="17" x2="15" y2="17"></line>
                        </svg>
                    </div>
                    <h2 class="card-title">Criar Eventos</h2>
                    <p class="card-description">Crie e gerencie eventos para a plataforma. Defina datas, horários, descrições e outras informações importantes.</p>
                    <a href="../view/Admin.php" class="btn btn-primary btn-colaborador">Acessar</a>
                </div>

                <!-- Card: Criar Cursos -->
                <div class="colaborador-card">
                    <div class="card-icon">
                       <img src="../Img/páginas dos cursos/Criar_cursos.png" alt="">
                    </div>
                    <h2 class="card-title">Criar Cursos</h2>
                    <p class="card-description">Crie e organize cursos para os usuários.</p>
                    <a href="../View/Criar_cursos.php" class="btn btn-primary btn-colaborador">Acessar</a>
                </div>
            </div>
        </div>
    </div>

   
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="colaborador.js"></script>
</body>
</html>
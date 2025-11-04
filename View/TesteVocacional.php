<?php
require_once __DIR__ . '/../controller/TesteVocacionalController.php';

$controller = new TesteVocacionalController();

if (isset($_GET['action']) && $_GET['action'] === 'dados') {
    $controller->dados();
} else {
    $controller->index();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Vocacional Interativo</title>
    <link rel="stylesheet" href="/Templates/css/teste-vocacional.css">
</head>
<body>
    <div id="app">
        <!-- Página Inicial -->
        <div id="home-page" class="page active">
            <header class="header">
                <div class="container">
                    <div class="header-content">
                        <div class="logo">
                            <span class="compass-icon">🧭</span>
                            <div>
                                <h1>Teste Vocacional</h1>
                                <p>Descubra sua carreira ideal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="main-content">
                <div class="container">
                    <div class="card hero-card">
                        <div class="hero-section">
                            <h2>Qual é sua vocação?</h2>
                            <p>Responda a 13 perguntas simples e descubra as carreiras que melhor se alinham com seus interesses, aptidões e valores.</p>
                        </div>

                        <div class="features-grid">
                            <div class="feature-card">
                                <div class="feature-icon">⏱️</div>
                                <h3>5 minutos</h3>
                                <p>Teste rápido e objetivo</p>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon">🎯</div>
                                <h3>Preciso</h3>
                                <p>Resultado personalizado</p>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon">🚀</div>
                                <h3>Gratuito</h3>
                                <p>Sem custos ou cadastro</p>
                            </div>
                        </div>

                        <button class="btn btn-primary" onclick="iniciarTeste()">Começar Teste Agora</button>

                        <div class="info-box">
                            <p>💡 <strong>Dica:</strong> Responda com sinceridade para obter resultados mais precisos.</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Página do Teste -->
        <div id="test-page" class="page">
            <header class="header">
                <div class="container">
                    <div class="header-content">
                        <h1>Teste Vocacional</h1>
                        <div class="progress-info">
                            <span id="question-counter">Pergunta 1 de 15</span>
                        </div>
                    </div>
                    <div class="progress-bar">
                        <div id="progress-fill" class="progress-fill"></div>
                    </div>
                </div>
            </header>

            <main class="main-content">
                <div class="container">
                    <div class="card test-card">
                        <div id="question-container">
                            <h2 id="question-text"></h2>
                            <div class="question-line"></div>
                            <div id="answers-container" class="answers-grid"></div>
                        </div>

                        <div class="navigation">
                            <button class="btn btn-outline" id="btn-previous" onclick="perguntaAnterior()" disabled>← Anterior</button>
                            <span id="question-display">1 / 15</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Página de Resultados -->
        <div id="results-page" class="page">
            <header class="header">
                <div class="container">
                    <button class="btn-back" onclick="voltarHome()">← Voltar</button>
                    <h1>Seus Resultados</h1>
                </div>
            </header>

            <main class="main-content">
                <div class="container">
                    <!-- Resultado Principal -->
                    <div class="top-result-card">
                        <div class="result-header">
                            <span class="award-icon">🏆</span>
                            <h2>Sua Área Principal</h2>
                        </div>
                        <div class="result-content">
                            <h3 id="top-area-name"></h3>
                            <p id="top-area-description"></p>
                        </div>
                    </div>

                    <!-- Gráfico de Pontuação -->
                    <div class="card chart-card">
                        <h3>Distribuição de Pontuação</h3>
                        <div id="chart-container" class="chart-container"></div>
                    </div>

                    <!-- Dica de IA -->
                    <div id="ia-dica-container"></div>

                    <!-- Top 3 Áreas -->
                    <div class="card">
                        <h3>Suas 3 Melhores Áreas</h3>
                        <div id="top-areas-container" class="areas-grid"></div>
                    </div>

                    <!-- Carreiras Recomendadas -->
                    <div class="card">
                        <h3>Carreiras Recomendadas</h3>
                        <div id="careers-container" class="careers-grid"></div>
                    </div>

                    <!-- CTA Final -->
                    <div class="card cta-card">
                        <h3>Próximos Passos</h3>
                        <p>Pesquise mais sobre essas carreiras, converse com profissionais da área e explore oportunidades de estágio ou cursos relacionados.</p>
                        <div style="display: flex; gap: 12px; margin-top: 20px;">
                            <button class="btn btn-primary" onclick="fazerTesteNovamente()" style="flex: 1;">Fazer Teste Novamente</button>
                            <button class="btn btn-outline" onclick="voltarHome()" style="flex: 1;">Voltar ao Início</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="/Templates/js/teste-vocacional.js"></script>
</body>
</html>

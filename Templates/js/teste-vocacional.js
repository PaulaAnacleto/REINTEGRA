
// Variáveis Globais
let perguntas = [];
let areas = {};
let perguntaAtual = 0;
let pontuacoes = {};

// Inicializar dados
document.addEventListener('DOMContentLoaded', function() {
    carregarDados();
});

// Carregar dados do PHP
function carregarDados() {
    fetch('../Controller/TesteVocacionalController.php?ajax=1')
        .then(response => response.json())
        .then(data => {
            perguntas = data.perguntas;
            areas = data.areas;
            
            // Inicializar pontuações
            Object.keys(areas).forEach(area => {
                pontuacoes[area] = 0;
            });
        })
        .catch(error => {
            console.error('Erro ao carregar dados:', error);
        });
}

// Iniciar Teste
function iniciarTeste() {
    perguntaAtual = 0;
    Object.keys(pontuacoes).forEach(area => {
        pontuacoes[area] = 0;
    });
    
    mostrarPagina('test-page');
    exibirPergunta();
}

// Exibir Pergunta
function exibirPergunta() {
    if (perguntaAtual >= perguntas.length) {
        exibirResultados();
        return;
    }

    const pergunta = perguntas[perguntaAtual];
    
    // Atualizar contador
    document.getElementById('question-counter').textContent = `Pergunta ${perguntaAtual + 1} de ${perguntas.length}`;
    document.getElementById('question-display').textContent = `${perguntaAtual + 1} / ${perguntas.length}`;
    
    // Atualizar barra de progresso
    const progresso = ((perguntaAtual + 1) / perguntas.length) * 100;
    document.getElementById('progress-fill').style.width = progresso + '%';
    
    // Exibir pergunta
    document.getElementById('question-text').textContent = pergunta.texto;
    
    // Exibir respostas
    const answersContainer = document.getElementById('answers-container');
    answersContainer.innerHTML = '';
    
    pergunta.respostas.forEach(resposta => {
        const btn = document.createElement('button');
        btn.className = 'answer-btn';
        btn.textContent = resposta.texto;
        btn.onclick = () => selecionarResposta(resposta);
        answersContainer.appendChild(btn);
    });
    
    // Atualizar botão anterior
    document.getElementById('btn-previous').disabled = perguntaAtual === 0;
}

// Selecionar Resposta
function selecionarResposta(resposta) {
    // Adicionar pontos
    Object.entries(resposta.areas).forEach(([area, pontos]) => {
        pontuacoes[area] += pontos;
    });
    
    // Próxima pergunta
    perguntaAtual++;
    exibirPergunta();
}

// Pergunta Anterior
function perguntaAnterior() {
    if (perguntaAtual > 0) {
        perguntaAtual--;
        exibirPergunta();
    }
}

// Exibir Resultados
function exibirResultados() {
    // Ordenar áreas por pontuação
    const areasOrdenadas = Object.entries(pontuacoes)
        .sort(([, a], [, b]) => b - a);
    
    const topArea = areasOrdenadas[0][0];
    const topAreaData = areas[topArea];
    
    // Exibir área principal
    document.getElementById('top-area-name').textContent = topAreaData.nome;
    document.getElementById('top-area-description').textContent = topAreaData.descricao;
    
    // Exibir gráfico interativo
    exibirGraficoInterativo(areasOrdenadas);
    
    // Exibir top 3 áreas
    exibirTop3Areas(areasOrdenadas);
    
    // Exibir carreiras
    exibirCarreiras(topAreaData);
    
    // Carregar dica de IA
    carregarDicaIA(topArea, areasOrdenadas[0][1]);
    
    // Mostrar página de resultados
    mostrarPagina('results-page');
}

// Exibir Gráfico Interativo com Barras Verticais
// ================================
// GRÁFICO MODERNO COM CHART.JS
// ================================
// ================================
// GRÁFICO MODERNO COM CHART.JS - VERSÃO RESPONSIVA
// ================================
let chartInstance = null;

function exibirGraficoInterativo(areasOrdenadas) {
    const container = document.getElementById('chart-container');
    container.innerHTML = '<canvas id="graficoPontuacao"></canvas>'; // Garante um canvas limpo

    const ctx = document.getElementById('graficoPontuacao').getContext('2d');

    const labels = areasOrdenadas.map(([area]) => areas[area].nome);
    const data = areasOrdenadas.map(([_, score]) => score);

    // Se já existe uma instância do gráfico, destrua-a antes de criar uma nova
    if (chartInstance) chartInstance.destroy();

    // --- LÓGICA PARA MUDAR TIPO DE GRÁFICO COM BASE NA TELA ---
    let chartType = 'bar'; // Tipo padrão para telas maiores
    let chartOptions = {}; // Objeto para as opções do gráfico

    // Se a largura da janela for menor ou igual a 520px (celular), usa gráfico de pizza
    if (window.innerWidth <= 520) {
        chartType = 'pie'; // Muda para gráfico de pizza
        chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom', // Move a legenda para a parte inferior para economizar espaço
                    labels: {
                        color: '#cbd5e1', // Cor do texto da legenda
                        font: {
                            size: 10 // Tamanho da fonte menor para a legenda
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleColor: '#fff',
                    bodyColor: '#cbd5e1',
                    borderColor: '#3b82f6',
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: true // Exibe a cor da fatia no tooltip
                },
                title: {
                    display: true,
                    text: 'Distribuição de Pontuação por Área',
                    color: '#f8fafc',
                    font: { size: 14, weight: 'bold' }, // Título menor
                    padding: { top: 10, bottom: 10 }
                }
            },
            // Gráficos de pizza não usam scales (eixos X e Y), então não precisamos defini-los aqui
            animation: {
                duration: 1200,
                easing: 'easeOutQuart'
            },
            onClick: (e, elements) => {
                if (elements.length > 0) {
                    const index = elements[0].index;
                    const areaClicada = labels[index];
                    alert(`🔎 Você clicou em ${areaClicada}`);
                }
            }
        };
    } else {
        // Opções para o gráfico de barras (o que você já tinha, com alguns ajustes)
        chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: { color: '#e2e8f0', font: { size: 14 } },
                    display: false // Mantém a legenda oculta para barras
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleColor: '#fff',
                    bodyColor: '#cbd5e1',
                    borderColor: '#3b82f6',
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: false
                },
                title: {
                    display: true,
                    text: 'Distribuição de Pontuação por Área',
                    color: '#f8fafc',
                    font: { size: 18, weight: 'bold' },
                    padding: { top: 10, bottom: 30 }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#cbd5e1',
                        font: { size: 12 },
                        maxRotation: 45, // Angula o texto do eixo X
                        minRotation: 45,
                        autoSkip: false // Tenta mostrar todos os labels
                    },
                    grid: { color: 'rgba(255,255,255,0.05)' }
                },
                y: {
                    ticks: { color: '#94a3b8', font: { size: 12 } },
                    grid: { color: 'rgba(255,255,255,0.08)' },
                    beginAtZero: true
                }
            },
            animation: {
                duration: 1200,
                easing: 'easeOutQuart'
            },
            onClick: (e, elements) => {
                if (elements.length > 0) {
                    const index = elements[0].index;
                    const areaClicada = labels[index];
                    alert(`🔎 Você clicou em ${areaClicada}`);
                }
            }
        };
    }

    // Cores das barras/fatias (as mesmas que você já tinha)
    const backgroundColors = [
        '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ef4444', '#0ea5e9'
    ];
    const borderColors = [
        '#1e293b', '#1e293b', '#1e293b', '#1e293b', '#1e293b', '#1e293b' // Borda consistente com o fundo do card
    ];

    chartInstance = new Chart(ctx, {
        type: chartType,
        data: {
            labels: labels,
            datasets: [{
                label: chartType === 'bar' ? 'Pontuação por Área' : 'Pontuação',
                data: data,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1.5,
                borderRadius: chartType === 'bar' ? 12 : 0, // Apenas para barras
            }]
        },
        options: chartOptions // Usa as opções dinâmicas
    });

    // Adiciona um listener para recriar o gráfico se a janela for redimensionada
    // e o tipo de gráfico precisar mudar.
    let resizeTimeout;
    window.removeEventListener('resize', handleChartResize); // Remove qualquer listener anterior
    window.addEventListener('resize', handleChartResize);
    
    function handleChartResize() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            // Verifica se o tipo de gráfico atual é diferente do que deveria ser
            const shouldBePie = window.innerWidth <= 520;
            const isCurrentlyPie = chartInstance.config.type === 'pie';

            if ((shouldBePie && !isCurrentlyPie) || (!shouldBePie && isCurrentlyPie)) {
                exibirGraficoInterativo(areasOrdenadas); // Recria o gráfico com o tipo correto
            }
        }, 300); // Pequeno atraso para evitar múltiplas execuções
    }
}


// Exibir Top 3 Áreas
function exibirTop3Areas(areasOrdenadas) {
    const container = document.getElementById('top-areas-container');
    container.innerHTML = '';
    
    const top3 = areasOrdenadas.slice(0, 3);
    
    top3.forEach(([areaKey, score], index) => {
        const area = areas[areaKey];
        const percentual = (score / 30) * 100; // Máximo teórico é 30 pontos
        
        const cardHTML = `
            <div class="area-card">
                <div class="area-header">
                    <h4>${area.nome}</h4>
                    <span class="area-rank">#${index + 1}</span>
                </div>
                <div class="area-score">
                    <span>Pontuação</span>
                    <span>${score}</span>
                </div>
                <div class="area-score-bar">
                    <div class="area-score-fill" style="width: ${percentual}%; background-color: ${area.cor}"></div>
                </div>
            </div>
        `;
        container.innerHTML += cardHTML;
    });
}

// Exibir Carreiras
function exibirCarreiras(topAreaData) {
    const container = document.getElementById('careers-container');
    container.innerHTML = '';
    
    topAreaData.carreiras.forEach(carreira => {
        const skillsHTML = carreira.competencias
            .map(skill => `<span class="skill-tag">${skill}</span>`)
            .join('');
        
        const cardHTML = `
            <div class="career-card">
                <h4>${carreira.nome}</h4>
                <p>${carreira.descricao}</p>
                <div class="skills-label">Competências</div>
                <div class="skills-container">
                    ${skillsHTML}
                </div>
            </div>
        `;
        container.innerHTML += cardHTML;
    });
}

// Carregar Dica de IA
function carregarDicaIA(area, score) {
    fetch(`../Controller/TesteVocacionalController.php?ia=1&area=${area}&score=${score}`)
        .then(response => response.json())
        .then(data => {
            if (data.sucesso) {
                const dicaContainer = document.getElementById('ia-dica-container');
                if (dicaContainer) {
                    dicaContainer.innerHTML = `
                        <div class="ia-dica-card">
                            <div class="ia-header">
                                <span class="ia-icon">🤖</span>
                                <h3>Dica de IA</h3>
                            </div>
                            <p>${data.dica}</p>
                        </div>
                    `;
                }
            }
        })
        .catch(error => console.error('Erro ao carregar dica de IA:', error));
}

// Mostrar Página
function mostrarPagina(pageId) {
    document.querySelectorAll('.page').forEach(page => {
        page.classList.remove('active');
    });
    document.getElementById(pageId).classList.add('active');
}

// Voltar Home
function voltarHome() {
    mostrarPagina('home-page');
}

// Fazer Teste Novamente
function fazerTesteNovamente() {
    iniciarTeste();
}
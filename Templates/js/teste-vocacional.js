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
function exibirGraficoInterativo(areasOrdenadas) {
    const chartContainer = document.getElementById('chart-container');
    chartContainer.innerHTML = '';
    
    const maxScore = Math.max(...areasOrdenadas.map(([, score]) => score)) || 1;
    
    // Criar SVG para gráfico
    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    svg.setAttribute('viewBox', '0 0 800 400');
    svg.setAttribute('class', 'chart-svg');
    svg.style.width = '100%';
    svg.style.height = 'auto';
    
    const padding = 60;
    const chartWidth = 800 - padding * 2;
    const chartHeight = 400 - padding * 2;
    const barWidth = chartWidth / areasOrdenadas.length;
    
    // Desenhar grid horizontal
    for (let i = 0; i <= 5; i++) {
        const y = padding + (chartHeight / 5) * i;
        const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
        line.setAttribute('x1', padding);
        line.setAttribute('y1', y);
        line.setAttribute('x2', 800 - padding);
        line.setAttribute('y2', y);
        line.setAttribute('stroke', '#475569');
        line.setAttribute('stroke-dasharray', '5,5');
        line.setAttribute('opacity', '0.5');
        svg.appendChild(line);
        
        // Labels do eixo Y
        const label = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        label.setAttribute('x', padding - 10);
        label.setAttribute('y', y + 5);
        label.setAttribute('text-anchor', 'end');
        label.setAttribute('fill', '#cbd5e1');
        label.setAttribute('font-size', '12');
        label.textContent = Math.round((maxScore / 5) * (5 - i));
        svg.appendChild(label);
    }
    
    // Desenhar barras
    areasOrdenadas.forEach(([areaKey, score], index) => {
        const area = areas[areaKey];
        const barHeight = (score / maxScore) * chartHeight;
        const x = padding + index * barWidth + barWidth * 0.1;
        const y = padding + chartHeight - barHeight;
        
        // Barra
        const rect = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
        rect.setAttribute('x', x);
        rect.setAttribute('y', y);
        rect.setAttribute('width', barWidth * 0.8);
        rect.setAttribute('height', barHeight);
        rect.setAttribute('fill', area.cor);
        rect.setAttribute('class', 'chart-bar');
        rect.setAttribute('rx', '4');
        
        // Efeito hover
        rect.addEventListener('mouseenter', function() {
            this.setAttribute('opacity', '0.8');
            this.style.filter = 'brightness(1.2)';
        });
        rect.addEventListener('mouseleave', function() {
            this.setAttribute('opacity', '1');
            this.style.filter = 'brightness(1)';
        });
        
        svg.appendChild(rect);
        
        // Valor na barra
        const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        text.setAttribute('x', x + barWidth * 0.4);
        text.setAttribute('y', y - 10);
        text.setAttribute('text-anchor', 'middle');
        text.setAttribute('fill', '#f1f5f9');
        text.setAttribute('font-size', '14');
        text.setAttribute('font-weight', 'bold');
        text.textContent = score;
        svg.appendChild(text);
        
        // Label do eixo X
        const label = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        label.setAttribute('x', x + barWidth * 0.4);
        label.setAttribute('y', padding + chartHeight + 25);
        label.setAttribute('text-anchor', 'middle');
        label.setAttribute('fill', '#cbd5e1');
        label.setAttribute('font-size', '12');
        label.textContent = area.nome.split(' &')[0];
        svg.appendChild(label);
    });
    
    // Eixo X
    const axisX = document.createElementNS('http://www.w3.org/2000/svg', 'line');
    axisX.setAttribute('x1', padding);
    axisX.setAttribute('y1', padding + chartHeight);
    axisX.setAttribute('x2', 800 - padding);
    axisX.setAttribute('y2', padding + chartHeight);
    axisX.setAttribute('stroke', '#cbd5e1');
    axisX.setAttribute('stroke-width', '2');
    svg.appendChild(axisX);
    
    // Eixo Y
    const axisY = document.createElementNS('http://www.w3.org/2000/svg', 'line');
    axisY.setAttribute('x1', padding);
    axisY.setAttribute('y1', padding);
    axisY.setAttribute('x2', padding);
    axisY.setAttribute('y2', padding + chartHeight);
    axisY.setAttribute('stroke', '#cbd5e1');
    axisY.setAttribute('stroke-width', '2');
    svg.appendChild(axisY);
    
    chartContainer.appendChild(svg);
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

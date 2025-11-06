// ================================
// VARIÁVEIS GLOBAIS
// ================================
let perguntas = [];
let areas = {};
let perguntaAtual = 0;
let pontuacoes = {};

// ================================
// INICIALIZAÇÃO
// ================================
document.addEventListener('DOMContentLoaded', function() {
    carregarDados();
});

// ================================
// CARREGAR DADOS DO CONTROLLER
// ================================
function carregarDados() {
    fetch('../Controller/TesteVocacionalController.php?ajax=1')
        .then(response => response.json())
        .then(data => {
            if (!data.perguntas || !data.areas) {
                throw new Error("Dados inválidos recebidos do servidor.");
            }

            perguntas = data.perguntas;
            areas = data.areas;
            pontuacoes = {};

            Object.keys(areas).forEach(area => pontuacoes[area] = 0);
        })
        .catch(error => console.error('Erro ao carregar dados:', error));
}

// ================================
// INICIAR TESTE
// ================================
function iniciarTeste() {
    perguntaAtual = 0;
    Object.keys(pontuacoes).forEach(area => pontuacoes[area] = 0);
    mostrarPagina('test-page');
    exibirPergunta();
}

// ================================
// EXIBIR PERGUNTA ATUAL
// ================================
function exibirPergunta() {
    if (perguntaAtual >= perguntas.length) return exibirResultados();

    const pergunta = perguntas[perguntaAtual];
    document.getElementById('question-counter').textContent =
        `Pergunta ${perguntaAtual + 1} de ${perguntas.length}`;
    document.getElementById('question-text').textContent = pergunta.texto;

    const answersContainer = document.getElementById('answers-container');
    answersContainer.innerHTML = '';

    pergunta.respostas.forEach(resposta => {
        const btn = document.createElement('button');
        btn.className = 'answer-btn';
        btn.textContent = resposta.texto;
        btn.onclick = () => selecionarResposta(resposta);
        answersContainer.appendChild(btn);
    });

    atualizarProgresso();
}

// ================================
// SELECIONAR RESPOSTA
// ================================
function selecionarResposta(resposta) {
    Object.entries(resposta.areas).forEach(([area, pontos]) => {
        pontuacoes[area] += pontos;
    });

    perguntaAtual++;
    exibirPergunta();
}

// ================================
// EXIBIR RESULTADOS
// ================================
function exibirResultados() {
    const areasOrdenadas = Object.entries(pontuacoes)
        .sort(([, a], [, b]) => b - a);

    const topArea = areasOrdenadas[0][0];
    const topAreaData = areas[topArea];

    document.getElementById('top-area-name').textContent = topAreaData.nome;
    document.getElementById('top-area-description').textContent = topAreaData.descricao;

    // Exibir as 3 melhores áreas
    const topAreasContainer = document.getElementById('top-areas-container');
    topAreasContainer.innerHTML = '';
    areasOrdenadas.slice(0, 3).forEach(([area, score]) => {
        const div = document.createElement('div');
        div.className = 'area-card';
        div.innerHTML = `<h4>${areas[area].nome}</h4><p>${score} pontos</p>`;
        topAreasContainer.appendChild(div);
    });

    // Chama a IA para gerar dica personalizada
    carregarDicaIA(topArea, areasOrdenadas[0][1]);

    mostrarPagina('results-page');
}

// ================================
// CARREGAR DICA PERSONALIZADA (GEMINI via PHP)
// ================================
function carregarDicaIA(area, score) {
    const dicaContainer = document.getElementById('ia-dica-text');
    dicaContainer.innerHTML = "<p>🤖 Gerando dica personalizada...</p>";

    fetch(`../Controller/TesteVocacionalController.php?ia=1&area=${encodeURIComponent(area)}&score=${score}`)
        .then(response => response.json())
        .then(data => {
            if (data.sucesso && data.dica) {
                dicaContainer.innerHTML = `<p>${data.dica}</p>`;
            } else {
                dicaContainer.innerHTML = "<p>Não foi possível gerar a dica personalizada no momento.</p>";
            }
        })
        .catch(error => {
            console.error('Erro IA:', error);
            dicaContainer.innerHTML = "<p>Erro ao conectar com a IA.</p>";
        });
}

// ================================
// CONTROLE DE NAVEGAÇÃO
// ================================
function mostrarPagina(id) {
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    document.getElementById(id).classList.add('active');
}

// ================================
// VOLTAR PARA HOME / REINICIAR
// ================================
function voltarHome() {
    mostrarPagina('home-page');
}

function fazerTesteNovamente() {
    iniciarTeste();
}

// ================================
// ATUALIZAR BARRA DE PROGRESSO
// ================================
function atualizarProgresso() {
    const progresso = ((perguntaAtual) / perguntas.length) * 100;
    document.getElementById('progress-fill').style.width = `${progresso}%`;
}

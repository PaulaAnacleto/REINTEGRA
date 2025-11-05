<?php
require_once '../Model/TesteVocacionalModel.php'; 

$model = new TesteVocacionalModel();

// Retorno sempre em JSON
header('Content-Type: application/json');

// ===============================
// 1. Requisição AJAX → Carregar perguntas e áreas
// ===============================
if (isset($_GET['ajax'])) {
    $perguntas = $model->getPerguntas();
    $areas = $model->getAreas();

    echo json_encode([
        'status' => 'ok',
        'perguntas' => $perguntas,
        'areas' => $areas
    ]);
    exit;
}

// ===============================
// 2. Requisição IA → Gerar dica vocacional aprofundada
// ===============================
if (isset($_GET['ia'])) {
    $area_principal = filter_input(INPUT_GET, 'area', FILTER_SANITIZE_STRING) ?? 'tecnologia';
    $pontuacao = filter_input(INPUT_GET, 'score', FILTER_VALIDATE_INT) ?? 0;

    // Novo prompt com tom empático, inspirador e prático
    $prompt = "
Você é um orientador vocacional experiente e empático, especializado em orientar jovens sobre futuro profissional.
Com base na área '$area_principal' e na pontuação de afinidade $pontuacao, escreva uma dica aprofundada e inspiradora (3 a 4 frases).
A mensagem deve:
- Mostrar entendimento emocional do momento da pessoa;
- Destacar os potenciais e caminhos dessa área;
- Sugerir ações concretas (como cursos, projetos, estágios, leituras ou vivências);
- Usar linguagem natural, positiva e humana, sem termos técnicos ou formais.

Responda apenas com o texto motivacional, sem título nem introdução.
";

    // Passa o prompt para o modelo gerar a resposta
    $dica = $model->getDica($area_principal, $pontuacao, $prompt);

    echo json_encode([
        'status' => 'ok',
        'sucesso' => true,
        'area' => $area_principal,
        'pontuacao' => $pontuacao,
        'dica' => $dica
    ]);
    exit;
}

// ===============================
// 3. Caso nenhuma condição seja atendida
// ===============================
echo json_encode([
    'status' => 'erro',
    'mensagem' => 'Requisição inválida.'
]);
exit;
?>

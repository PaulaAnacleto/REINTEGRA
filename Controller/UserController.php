<?php
session_start();
require_once __DIR__ . '/../Model/UserModel.php'; // (Assumindo que está na pasta Model)

// --- Verificação de Segurança (para ambas as ações) ---
if (!isset($_SESSION['id_usuario'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit;
}

$userModel = new UserModel();
$id_usuario = $_SESSION['id_usuario'];

// Verifica qual o método da requisição (GET para buscar, POST para salvar)
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "GET") {
    // --- AÇÃO: BUSCAR DADOS DO USUÁRIO (para o loadUserData) ---
    
    $usuario = $userModel->findById($id_usuario);
    
    header('Content-Type: application/json');
    if ($usuario) {
        // Remove dados sensíveis antes de enviar
        unset($usuario['senha']); 
        echo json_encode(['success' => true, 'data' => $usuario]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuário não encontrado.']);
    }
    exit;
}

if ($method == "POST") {
    // --- AÇÃO: ATUALIZAR PERFIL (para o saveChanges) ---
    
    // Os dados vêm do 'new FormData(profileForm)' no JS
    $data = [
        'nomeCompleto' => htmlspecialchars(trim($_POST['nomeCompleto'])),
        'email' => filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL),
        'dataNascimento' => trim($_POST['dataNascimento']),
        'cpf' => htmlspecialchars(trim($_POST['cpf'])),
        'profissao' => htmlspecialchars(trim($_POST['profissao']))
    ];
    
    // Validação de email duplicado (como fizemos antes)
    $usuarioAtual = $userModel->findById($id_usuario);
    if ($data['email'] != $usuarioAtual['email']) {
        if ($userModel->findByEmail($data['email'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Este email já está em uso.']);
            exit;
        }
    }

    // Tenta atualizar
    $sucesso = $userModel->update($id_usuario, $data);
    
    header('Content-Type: application/json');
    if ($sucesso) {
        // Atualiza o nome na sessão também, caso tenha mudado
        $_SESSION['nome_usuario'] = $data['nomeCompleto']; 
        echo json_encode(['success' => true, 'message' => 'Perfil atualizado com sucesso!', 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar o perfil no banco.']);
    }
    exit;
}
?>
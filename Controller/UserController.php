<?php
session_start();
require_once __DIR__ . '/../Model/UserModel.php';

// Define o tipo de resposta como JSON para o JavaScript
header('Content-Type: application/json');

$userModel = new UserModel();
$method = $_SERVER["REQUEST_METHOD"];

// --- AÇÃO: BUSCAR DADOS DO PERFIL (GET) ---
// (Usado pelo perfil.js quando a página de Perfil carrega)
if ($method == "GET") {
    if (!isset($_SESSION['id_usuario'])) {
        echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
        exit;
    }
    
    $usuario = $userModel->findById($_SESSION['id_usuario']);
    
    if ($usuario) {
        unset($usuario['senha']); // Nunca envie a senha de volta
        echo json_encode(['success' => true, 'data' => $usuario]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuário não encontrado.']);
    }
    exit;
}

// --- AÇÕES: LOGIN, CADASTRO, UPDATE (POST) ---
// (Usado por cadastro.js, login.js e perfil.js)
if ($method == "POST") {
    
    // Pega a 'action' que o JavaScript envia para sabermos o que fazer
    $action = $_POST['action'] ?? '';

    switch ($action) {
        
        // --- CASO: CADASTRO ---
        case 'register':
            $nome = trim($_POST['nomeCompleto'] ?? '');
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'] ?? '';
            $confSenha = $_POST['confirmarSenha'] ?? '';

            if (empty($nome) || empty($email) || empty($senha)) {
                echo json_encode(['success' => false, 'message' => 'Todos os campos são obrigatórios.']);
                exit;
            }
            if ($senha !== $confSenha) {
                echo json_encode(['success' => false, 'message' => 'As senhas não conferem.']);
                exit;
            }
            
            // --- VALIDAÇÃO DE SENHA ATUALIZADA ---
            // (Regex para: min 8 chars, 1 maiúscula, 1 minúscula, 1 número)
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d@$!%*?&]{8,}$/', $senha)) {
                 echo json_encode(['success' => false, 'message' => 'Senha inválida. Deve ter 8+ caracteres, 1 maiúscula, 1 minúscula e 1 número.']);
                 exit;
            }
            // --- FIM DA ATUALIZAÇÃO ---
            
            if ($userModel->findByEmail($email)) {
                echo json_encode(['success' => false, 'message' => 'Este email já está cadastrado.']);
                exit;
            }

            // Criptografa a senha (IMPORTANTE)
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $sucesso = $userModel->register($nome, $email, $senhaHash);
            
            if ($sucesso) {
                echo json_encode(['success' => true, 'message' => 'Cadastro realizado com sucesso!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao salvar no banco. Tente novamente.']);
            }
            break;

        // --- CASO: LOGIN ---
        case 'login':
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'] ?? '';

            if (empty($email) || empty($senha)) {
                echo json_encode(['success' => false, 'message' => 'Email e senha são obrigatórios.']);
                exit;
            }

            $usuario = $userModel->findByEmail($email);

            // Verifica se o usuário existe E se a senha criptografada bate
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                // Sucesso! Cria a sessão
                $_SESSION['id_usuario'] = $usuario['id'];
                $_SESSION['nome_usuario'] = $usuario['nomeCompleto'];
                
                echo json_encode(['success' => true, 'message' => 'Login bem-sucedido!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Email ou senha inválidos.']);
            }
            break;

        // --- CASO: ATUALIZAR PERFIL ---
        case 'update_profile':
            if (!isset($_SESSION['id_usuario'])) {
                echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
                exit;
            }
            
            $id = $_SESSION['id_usuario'];
            $data = [
                'nomeCompleto' => htmlspecialchars(trim($_POST['nomeCompleto'])),
                'email' => filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL),
                'dataNascimento' => trim($_POST['dataNascimento']),
                'cpf' => htmlspecialchars(trim($_POST['cpf'])),
                'profissao' => htmlspecialchars(trim($_POST['profissao']))
            ];

            // Validação de email duplicado
            $usuarioAtual = $userModel->findById($id);
            if ($data['email'] != $usuarioAtual['email'] && $userModel->findByEmail($data['email'])) {
                echo json_encode(['success' => false, 'message' => 'Este email já está em uso.']);
                exit;
            }

            $sucesso = $userModel->update($id, $data);
            
            if ($sucesso) {
                $_SESSION['nome_usuario'] = $data['nomeCompleto']; // Atualiza o nome na sessão
                echo json_encode(['success' => true, 'message' => 'Perfil atualizado!', 'data' => $data]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao atualizar o perfil.']);
            }
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Ação desconhecida.']);
            break;
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
?>
<?php

namespace Controller;

use Model\UserModel;

class UserController
{
    private $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * Ponto de entrada que roteia a requisição para o método correto.
     */
    public function handleRequest(string $method, array $post, array &$session): array
    {
        if ($method === 'GET') {
            return $this->getProfile($session);
        }

        if ($method === 'POST') {
            $action = $post['action'] ?? '';
            switch ($action) {
                case 'register':
                    return $this->register($post);
                case 'login':
                    return $this->login($post, $session);
                case 'update_profile':
                    return $this->updateProfile($post, $session);
                default:
                    return ['success' => false, 'message' => 'Ação desconhecida.'];
            }
        }

        return ['success' => false, 'message' => 'Método não permitido.'];
    }

    public function getProfile(array $session): array
    {
        if (!isset($session['id_usuario'])) {
            return ['success' => false, 'message' => 'Usuário não autenticado.'];
        }
        
        $usuario = $this->userModel->findById($session['id_usuario']);
        
        if ($usuario) {
            unset($usuario['senha']);
            return ['success' => true, 'data' => $usuario];
        }
        
        return ['success' => false, 'message' => 'Usuário não encontrado.'];
    }

    public function register(array $data): array
    {
        $nome = trim($data['nomeCompleto'] ?? '');
        $email = filter_var(trim($data['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $senha = $data['senha'] ?? '';
        $confSenha = $data['confirmarSenha'] ?? '';

        if (empty($nome) || empty($email) || empty($senha)) {
            return ['success' => false, 'message' => 'Todos os campos são obrigatórios.'];
        }
        if ($senha !== $confSenha) {
            return ['success' => false, 'message' => 'As senhas não conferem.'];
        }
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d@$!%*?&]{8,}$/', $senha)) {
            return ['success' => false, 'message' => 'Senha inválida. Deve ter 8+ caracteres, 1 maiúscula, 1 minúscula e 1 número.'];
        }
        if ($this->userModel->findByEmail($email)) {
            return ['success' => false, 'message' => 'Este email já está cadastrado.'];
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sucesso = $this->userModel->register($nome, $email, $senhaHash);
        
        return $sucesso
            ? ['success' => true, 'message' => 'Cadastro realizado com sucesso!']
            : ['success' => false, 'message' => 'Erro ao salvar no banco. Tente novamente.'];
    }

    public function login(array $data, array &$session): array
    {
        $email = filter_var(trim($data['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $senha = $data['senha'] ?? '';

        if (empty($email) || empty($senha)) {
            return ['success' => false, 'message' => 'Email e senha são obrigatórios.'];
        }

        $usuario = $this->userModel->findByEmail($email);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Modifica a sessão passada por referência
            $session['id_usuario'] = $usuario['id'];
            $session['nome_usuario'] = $usuario['nomeCompleto'];
            return ['success' => true, 'message' => 'Login bem-sucedido!'];
        }
        
        return ['success' => false, 'message' => 'Email ou senha inválidos.'];
    }

    public function updateProfile(array $data, array &$session): array
    {
        if (!isset($session['id_usuario'])) {
            return ['success' => false, 'message' => 'Usuário não autenticado.'];
        }

        $id = $session['id_usuario'];
        $updateData = [
            'nomeCompleto' => htmlspecialchars(trim($data['nomeCompleto'])),
            'email' => filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL),
            'dataNascimento' => trim($data['dataNascimento']),
            'cpf' => htmlspecialchars(trim($data['cpf'])),
            'profissao' => htmlspecialchars(trim($data['profissao']))
        ];

        $usuarioAtual = $this->userModel->findById($id);
        if ($updateData['email'] != $usuarioAtual['email'] && $this->userModel->findByEmail($updateData['email'])) {
            return ['success' => false, 'message' => 'Este email já está em uso.'];
        }

        $sucesso = $this->userModel->update($id, $updateData);
        
        if ($sucesso) {
            $session['nome_usuario'] = $updateData['nomeCompleto'];
            return ['success' => true, 'message' => 'Perfil atualizado!', 'data' => $updateData];
        }
        
        return ['success' => false, 'message' => 'Erro ao atualizar o perfil.'];
    }
}

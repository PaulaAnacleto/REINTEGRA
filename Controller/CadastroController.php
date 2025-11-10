<?php

namespace Controller;

use Model\User;

class CadastroController
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * Processa a requisição de cadastro.
     * Retorna um array com o status e uma mensagem.
     */
    public function cadastrar(array $postData): array
    {
        // 1. Extrair e limpar os dados
        $nome = trim($postData['nomeCompleto'] ?? '');
        $email = trim($postData['email'] ?? '');
        $senha = $postData['senha'] ?? '';
        $confirmarSenha = $postData['confirmarSenha'] ?? '';

        // 2. Validar os dados
        if (empty($nome) || empty($email) || empty($senha)) {
            return ['success' => false, 'message' => 'Todos os campos são obrigatórios.'];
        }

        if (str_word_count($nome) < 2) {
            return ['success' => false, 'message' => 'Digite seu nome completo (nome e sobrenome).'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Digite um email válido.'];
        }

        if (strlen($senha) < 8 || !preg_match('/[A-Z]/', $senha) || !preg_match('/[a-z]/', $senha) || !preg_match('/[0-9]/', $senha)) {
            return ['success' => false, 'message' => 'A senha deve ter pelo menos 8 caracteres, incluindo maiúscula, minúscula e número.'];
        }

        if ($senha !== $confirmarSenha) {
            return ['success' => false, 'message' => 'As senhas não coincidem.'];
        }

        // 3. Verificar se o email já existe
        if ($this->userModel->emailExists($email)) {
            return ['success' => false, 'message' => 'Este email já está cadastrado.'];
        }

        // 4. Salvar o usuário
        $userId = $this->userModel->save($nome, $email, $senha);

        if ($userId) {
            return ['success' => true, 'message' => 'Cadastro realizado com sucesso!', 'userId' => $userId];
        } else {
            return ['success' => false, 'message' => 'Ocorreu um erro ao salvar o usuário. Tente novamente.'];
        }
    }
}

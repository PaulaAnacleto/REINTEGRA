<?php

use PHPUnit\Framework\TestCase;
use Controller\CadastroController;
use Model\User;

class CadastroTest extends TestCase
{
    private $userModelMock;
    private $cadastroController;

    protected function setUp(): void
    {
        $this->userModelMock = $this->createMock(User::class);
        $this->cadastroController = new CadastroController($this->userModelMock);
    }

    // ✅ Cadastro com sucesso: O controller chama o save quando os dados são válidos.
    public function testCadastroComSucesso()
    {
        $dadosFormulario = [
            'nomeCompleto' => 'Usuario Teste',
            'email' => 'teste@exemplo.com',
            'senha' => 'SenhaForte123',
            'confirmarSenha' => 'SenhaForte123'
        ];

        $this->userModelMock->method('emailExists')->with($this->equalTo('teste@exemplo.com'))->willReturn(false);
        $this->userModelMock->method('save')->willReturn(1);

        $resultado = $this->cadastroController->cadastrar($dadosFormulario);

        $this->assertTrue($resultado['success']);
        $this->assertEquals('Cadastro realizado com sucesso!', $resultado['message']);
    }

    // ✅ Falha por e-mail existente: Ele impede o cadastro se o e-mail já estiver em uso.
    public function testCadastroFalhaEmailJaExistente()
    {
        $dadosFormulario = [
            'nomeCompleto' => 'Usuario Repetido',
            'email' => 'repetido@exemplo.com',
            'senha' => 'SenhaForte123',
            'confirmarSenha' => 'SenhaForte123'
        ];

        $this->userModelMock->method('emailExists')->with($this->equalTo('repetido@exemplo.com'))->willReturn(true);

        $resultado = $this->cadastroController->cadastrar($dadosFormulario);

        $this->assertFalse($resultado['success']);
        $this->assertEquals('Este email já está cadastrado.', $resultado['message']);
    }

    // ✅ Falha por senhas diferentes: Ele recusa o cadastro se as senhas não baterem.
    public function testCadastroFalhaSenhasNaoCoincidem()
    {
        $dadosFormulario = [
            'nomeCompleto' => 'Usuario Teste',
            'email' => 'teste@exemplo.com',
            'senha' => 'SenhaForte123',
            'confirmarSenha' => 'SenhaErrada456'
        ];

        $resultado = $this->cadastroController->cadastrar($dadosFormulario);

        $this->assertFalse($resultado['success']);
        $this->assertEquals('As senhas não coincidem.', $resultado['message']);
    }

    // ✅ Falha por senha fraca: Ele valida a complexidade da senha corretamente.
    public function testCadastroFalhaSenhaFraca()
    {
        $dadosFormulario = [
            'nomeCompleto' => 'Usuario Teste',
            'email' => 'teste@exemplo.com',
            'senha' => 'fraca',
            'confirmarSenha' => 'fraca'
        ];

        $resultado = $this->cadastroController->cadastrar($dadosFormulario);

        $this->assertFalse($resultado['success']);
        $this->assertEquals('A senha deve ter pelo menos 8 caracteres, incluindo maiúscula, minúscula e número.', $resultado['message']);
    }
}

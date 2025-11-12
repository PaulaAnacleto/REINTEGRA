<?php
use PHPUnit\Framework\TestCase;

class CriarCursosViewTest extends TestCase
{
    /** @var PHPUnit\Framework\MockObject\MockObject|CursosController */
    private $controllerMock;

    protected function setUp(): void
    {
        require_once __DIR__ . '/../Controller/Cursos_controller.php';
        $this->controllerMock = $this->createMock(CursosController::class);
        $_SERVER['REQUEST_METHOD'] = 'GET';
    }

    private function renderViewWithMock(array $dados_view, array $cursos = []): string
    {
        // Configura o mock
        $this->controllerMock->method('handleAdminRequest')->willReturn($dados_view);
        $this->controllerMock->method('getCursosPublico')->willReturn($cursos);

        // Cria um namespace temporário com a classe mockada
        $mock = $this->controllerMock;

        $tempFile = tempnam(sys_get_temp_dir(), 'test_view_');
        $viewCode = str_replace(
            'new CursosController()',
            '(\Reintegra\Tests\CriarCursosViewTest::$mock)',
            file_get_contents(__DIR__ . '/../View/Criar_curso.php')
        );

        file_put_contents($tempFile, "<?php namespace Reintegra\\Tests; class CriarCursosViewTest { public static \$mock; } ?>\n" . $viewCode);
        \Reintegra\Tests\CriarCursosViewTest::$mock = $mock;

        ob_start();
        include $tempFile;
        $output = ob_get_clean();

        unlink($tempFile);
        return $output;
    }

    /** @test */
    public function deve_exibir_titulo_criar_novo_curso_quando_nao_estiver_em_edicao()
    {
        $dados_view = ['acao' => 'criar', 'curso' => null];
        $html = $this->renderViewWithMock($dados_view);

        $this->assertStringContainsString('Criar Novo Curso', $html);
        $this->assertStringContainsString('Salvar Novo Curso', $html);
    }

    /** @test */
    public function deve_exibir_titulo_editar_curso_quando_em_modo_edicao()
    {
        $dados_view = [
            'acao' => 'editar',
            'curso' => [
                'idcurso' => 1,
                'Titulo' => 'Curso Teste',
                'Links' => 'https://teste.com',
                'Descricao_cur' => 'Descrição'
            ]
        ];

        $html = $this->renderViewWithMock($dados_view);

        $this->assertStringContainsString('Editar Curso', $html);
        $this->assertStringContainsString('Salvar Alterações', $html);
        $this->assertStringContainsString('Curso Teste', $html);
    }

    /** @test */
    public function deve_mostrar_mensagem_de_lista_vazia_quando_nao_houver_cursos()
    {
        $dados_view = ['acao' => 'listar', 'curso' => null];
        $html = $this->renderViewWithMock($dados_view, []);

        $this->assertStringContainsString('Nenhum curso cadastrado', $html);
    }

    /** @test */
    public function deve_listar_cursos_na_tabela_quando_existirem()
    {
        $dados_view = ['acao' => 'listar', 'curso' => null];
        $cursos = [
            ['idcurso' => 1, 'Titulo' => 'Curso PHP', 'Links' => 'https://php.net', 'Descricao_cur' => 'Aprenda PHP']
        ];

        $html = $this->renderViewWithMock($dados_view, $cursos);

        $this->assertStringContainsString('Curso PHP', $html);
        $this->assertStringContainsString('https://php.net', $html);
    }
}
<?php

use PHPUnit\Framework\TestCase;

// ------------------------------------------------------------
// Dependências simuladas (mockadas)
// ------------------------------------------------------------

// Interface simulada para representar a camada de dados (Model/Repository)
interface CursosRepositoryInterface
{
    public function findAllPublic(): array;
}

// ------------------------------------------------------------
// Classe simulada do Controller
// ------------------------------------------------------------

class CursosController
{
    private $repository;

    public function __construct(?CursosRepositoryInterface $repository = null)
    {
        $this->repository = $repository;
    }

    public function getCursosPublico(): array
    {
        if ($this->repository === null) {
            return [];
        }

        return $this->repository->findAllPublic();
    }
}

// ------------------------------------------------------------
// CLASSE DE TESTE PHPUNIT
// ------------------------------------------------------------

class CursosControllerTest extends TestCase
{
    /**
     * Testa o cenário onde o método getCursosPublico retorna uma lista de cursos.
     */
    public function testGetCursosPublico_DeveRetornarCursos()
    {
        // 1. Dados simulados de cursos
        $dadosCursos = [
            [
                'Links' => 'http://link1.com',
                'Titulo' => 'Curso de PHP',
                'Descricao_cur' => 'Aprenda PHP do zero.'
            ],
            [
                'Links' => 'http://link2.com',
                'Titulo' => 'Curso de Laravel',
                'Descricao_cur' => 'Framework Laravel.'
            ],
        ];

        // 2. Criação do Mock do Repository
        $mockRepository = $this->createMock(CursosRepositoryInterface::class);

        // 3. Configuração do Mock — quando o método findAllPublic for chamado,
        // ele deve retornar o array $dadosCursos
        $mockRepository->expects($this->once())
                       ->method('findAllPublic')
                       ->willReturn($dadosCursos);

        // 4. Instancia o Controller com o Mock injetado
        $controller = new CursosController($mockRepository);

        // 5. Executa o método a ser testado
        $cursosRetornados = $controller->getCursosPublico();

        // 6. Asserções — verifica se tudo está conforme o esperado
        $this->assertIsArray($cursosRetornados);
        $this->assertCount(2, $cursosRetornados);
        $this->assertEquals($dadosCursos, $cursosRetornados);

        // Verifica se a estrutura de um curso está correta
        $this->assertArrayHasKey('Links', $cursosRetornados[0]);
        $this->assertArrayHasKey('Titulo', $cursosRetornados[0]);
        $this->assertArrayHasKey('Descricao_cur', $cursosRetornados[0]);
    }

    /**
     * Testa o cenário onde o método getCursosPublico retorna um array vazio.
     */
    public function testGetCursosPublico_DeveRetornarArrayVazio()
    {
        // 1. Criação do Mock para a dependência (Repository)
        $mockRepository = $this->createMock(CursosRepositoryInterface::class);

        // 2. Configuração do Mock: o método findAllPublic deve retornar um array vazio
        $mockRepository->expects($this->once())
                       ->method('findAllPublic')
                       ->willReturn([]);

        // 3. Instanciação do Controller com o Mock injetado
        $controller = new CursosController($mockRepository);

        // 4. Execução do método
        $cursosRetornados = $controller->getCursosPublico();

        // 5. Asserções
        $this->assertIsArray($cursosRetornados);
        $this->assertEmpty($cursosRetornados);
        $this->assertCount(0, $cursosRetornados);
    }

    /**
     * Testa o cenário em que o Controller é instanciado sem um Repository.
     */
    public function testGetCursosPublico_SemRepository_DeveRetornarArrayVazio()
    {
        // 1. Controller sem injeção de dependência
        $controller = new CursosController();

        // 2. Execução do método
        $resultado = $controller->getCursosPublico();

        // 3. Asserções
        $this->assertIsArray($resultado);
        $this->assertEmpty($resultado);
    }
}

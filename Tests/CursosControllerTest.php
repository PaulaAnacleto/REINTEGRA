<?php

use PHPUnit\Framework\TestCase;

// Interface simulada para representar a camada de dados (Model/Repository)
interface CursosRepositoryInterface
{
    public function findAllPublic(): array;
}



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



class CursosControllerTest extends TestCase
{
 
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

        $mockRepository = $this->createMock(CursosRepositoryInterface::class);


        $mockRepository->expects($this->once())
                       ->method('findAllPublic')
                       ->willReturn($dadosCursos);

        $controller = new CursosController($mockRepository);

        $cursosRetornados = $controller->getCursosPublico();

        $this->assertIsArray($cursosRetornados);
        $this->assertCount(2, $cursosRetornados);
        $this->assertEquals($dadosCursos, $cursosRetornados);

        // Verifica se a estrutura de um curso está correta
        $this->assertArrayHasKey('Links', $cursosRetornados[0]);
        $this->assertArrayHasKey('Titulo', $cursosRetornados[0]);
        $this->assertArrayHasKey('Descricao_cur', $cursosRetornados[0]);
    }

    public function testGetCursosPublico_DeveRetornarArrayVazio()
    {
        // Criação do Mock
        $mockRepository = $this->createMock(CursosRepositoryInterface::class);


        $mockRepository->expects($this->once())
                       ->method('findAllPublic')
                       ->willReturn([]);


        $controller = new CursosController($mockRepository);


        $cursosRetornados = $controller->getCursosPublico();


        $this->assertIsArray($cursosRetornados);
        $this->assertEmpty($cursosRetornados);
        $this->assertCount(0, $cursosRetornados);
    }

 
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

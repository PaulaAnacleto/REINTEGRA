<?php
class TesteVocacionalModel {
    public function getPerguntasEAreas() {
        $perguntas = [
            [
                'id' => 1,
                'texto' => 'Qual atividade você mais gosta de fazer?',
                'respostas' => [
                    ['id' => 1, 'texto' => 'Resolver problemas com lógica e programação', 'areas' => ['tecnologia' => 3, 'ciencias' => 1]],
                    ['id' => 2, 'texto' => 'Cuidar da saúde e bem-estar físico', 'areas' => ['saude' => 3, 'ciencias' => 1]],
                    ['id' => 3, 'texto' => 'Criar coisas novas e artísticas', 'areas' => ['criativa' => 3, 'tecnologia' => 1]],
                    ['id' => 4, 'texto' => 'Gerenciar projetos e negócios', 'areas' => ['negocios' => 3, 'humanas' => 1]]
                ]
            ],
            [
                'id' => 2,
                'texto' => 'Como você prefere trabalhar?',
                'respostas' => [
                    ['id' => 5, 'texto' => 'Colaborando e discutindo ideias com equipe', 'areas' => ['humanas' => 3, 'negocios' => 1]],
                    ['id' => 6, 'texto' => 'De forma independente e focada', 'areas' => ['tecnologia' => 2, 'criativa' => 1]],
                    ['id' => 7, 'texto' => 'Ajudando pessoas a se recuperarem ou melhorarem', 'areas' => ['saude' => 3, 'ciencias' => 1]],
                    ['id' => 8, 'texto' => 'Analisando dados e números', 'areas' => ['ciencias' => 2, 'negocios' => 1]]
                ]
            ],
            [
                'id' => 3,
                'texto' => 'Qual assunto mais te interessa?',
                'respostas' => [
                    ['id' => 9, 'texto' => 'Tecnologia e inovação', 'areas' => ['tecnologia' => 3, 'ciencias' => 1]],
                    ['id' => 10, 'texto' => 'Medicina, enfermagem e tratamentos', 'areas' => ['saude' => 3, 'ciencias' => 1]],
                    ['id' => 11, 'texto' => 'Arte, design e cultura', 'areas' => ['criativa' => 3, 'humanas' => 1]],
                    ['id' => 12, 'texto' => 'Economia e administração', 'areas' => ['negocios' => 3, 'ciencias' => 1]]
                ]
            ],
            [
                'id' => 4,
                'texto' => 'Qual é seu maior ponto forte?',
                'respostas' => [
                    ['id' => 13, 'texto' => 'Pensamento analítico e técnico', 'areas' => ['tecnologia' => 2, 'ciencias' => 2]],
                    ['id' => 14, 'texto' => 'Empatia e compreensão das pessoas', 'areas' => ['humanas' => 3, 'saude' => 1]],
                    ['id' => 15, 'texto' => 'Criatividade e inovação', 'areas' => ['criativa' => 3, 'tecnologia' => 1]],
                    ['id' => 16, 'texto' => 'Liderança e organização', 'areas' => ['negocios' => 3, 'humanas' => 1]]
                ]
            ],
            [
                'id' => 5,
                'texto' => 'O que mais te motiva no trabalho?',
                'respostas' => [
                    ['id' => 17, 'texto' => 'Resolver desafios complexos', 'areas' => ['tecnologia' => 2, 'ciencias' => 2]],
                    ['id' => 18, 'texto' => 'Salvar vidas e melhorar a saúde das pessoas', 'areas' => ['saude' => 3, 'ciencias' => 1]],
                    ['id' => 19, 'texto' => 'Expressar criatividade', 'areas' => ['criativa' => 3, 'humanas' => 1]],
                    ['id' => 20, 'texto' => 'Crescimento e sucesso financeiro', 'areas' => ['negocios' => 3, 'ciencias' => 1]]
                ]
            ],
            [
                'id' => 6,
                'texto' => 'Como você se vê em 10 anos?',
                'respostas' => [
                    ['id' => 21, 'texto' => 'Especialista em minha área técnica', 'areas' => ['tecnologia' => 3, 'ciencias' => 1]],
                    ['id' => 22, 'texto' => 'Profissional respeitado na saúde', 'areas' => ['saude' => 3, 'ciencias' => 1]],
                    ['id' => 23, 'texto' => 'Criador reconhecido em meu campo', 'areas' => ['criativa' => 3, 'tecnologia' => 1]],
                    ['id' => 24, 'texto' => 'Líder em uma empresa ou projeto', 'areas' => ['negocios' => 3, 'humanas' => 2]]
                ]
            ],
            [
                'id' => 7,
                'texto' => 'Qual ambiente de trabalho você prefere?',
                'respostas' => [
                    ['id' => 25, 'texto' => 'Escritório moderno com tecnologia', 'areas' => ['tecnologia' => 2, 'negocios' => 1]],
                    ['id' => 26, 'texto' => 'Hospital, clínica ou ambiente médico', 'areas' => ['saude' => 3, 'ciencias' => 1]],
                    ['id' => 27, 'texto' => 'Estúdio ou espaço criativo', 'areas' => ['criativa' => 3, 'humanas' => 1]],
                    ['id' => 28, 'texto' => 'Escritório corporativo', 'areas' => ['negocios' => 2, 'humanas' => 1]]
                ]
            ],
            [
                'id' => 8,
                'texto' => 'Qual tipo de estudo mais te atrai?',
                'respostas' => [
                    ['id' => 29, 'texto' => 'Programação e desenvolvimento', 'areas' => ['tecnologia' => 3, 'ciencias' => 1]],
                    ['id' => 30, 'texto' => 'Medicina, enfermagem ou farmácia', 'areas' => ['saude' => 3, 'ciencias' => 2]],
                    ['id' => 31, 'texto' => 'Educação, história ou filosofia', 'areas' => ['humanas' => 3, 'ciencias' => 1]],
                    ['id' => 32, 'texto' => 'Administração ou economia', 'areas' => ['negocios' => 3, 'ciencias' => 1]]
                ]
            ],
            [
                'id' => 9,
                'texto' => 'Como você lida com mudanças?',
                'respostas' => [
                    ['id' => 33, 'texto' => 'Adoro aprender coisas novas', 'areas' => ['tecnologia' => 2, 'ciencias' => 2]],
                    ['id' => 34, 'texto' => 'Prefiro estabilidade e rotina', 'areas' => ['saude' => 2, 'negocios' => 1]],
                    ['id' => 35, 'texto' => 'Vejo como oportunidade de inovar', 'areas' => ['criativa' => 2, 'tecnologia' => 1]],
                    ['id' => 36, 'texto' => 'Adapto-me e busco oportunidades', 'areas' => ['negocios' => 2, 'humanas' => 2]]
                ]
            ],
            [
                'id' => 10,
                'texto' => 'Qual seria seu maior satisfação profissional?',
                'respostas' => [
                    ['id' => 37, 'texto' => 'Criar tecnologias que mudam o mundo', 'areas' => ['tecnologia' => 3, 'ciencias' => 1]],
                    ['id' => 38, 'texto' => 'Salvar vidas e melhorar a saúde', 'areas' => ['saude' => 3, 'ciencias' => 1]],
                    ['id' => 39, 'texto' => 'Transformar a educação e a sociedade', 'areas' => ['humanas' => 3, 'ciencias' => 1]],
                    ['id' => 40, 'texto' => 'Construir um negócio bem-sucedido', 'areas' => ['negocios' => 3, 'ciencias' => 1]]
                ]
            ],
            [
                'id' => 11,
                'texto' => 'Qual tipo de impacto social você quer ter?',
                'respostas' => [
                    ['id' => 41, 'texto' => 'Transformar a sociedade através da educação', 'areas' => ['humanas' => 3, 'ciencias' => 1]],
                    ['id' => 42, 'texto' => 'Melhorar a qualidade de vida através da saúde', 'areas' => ['saude' => 3, 'humanas' => 1]],
                    ['id' => 43, 'texto' => 'Contribuir para avanços científicos', 'areas' => ['ciencias' => 3, 'tecnologia' => 1]],
                    ['id' => 44, 'texto' => 'Criar soluções inovadoras', 'areas' => ['tecnologia' => 3, 'criativa' => 1]]
                ]
            ],
            [
                'id' => 12,
                'texto' => 'Como você se relaciona com outras pessoas?',
                'respostas' => [
                    ['id' => 45, 'texto' => 'Sou muito social e gosto de networking', 'areas' => ['humanas' => 3, 'negocios' => 1]],
                    ['id' => 46, 'texto' => 'Prefiro trabalhar com poucas pessoas próximas', 'areas' => ['criativa' => 2, 'tecnologia' => 1]],
                    ['id' => 47, 'texto' => 'Gosto de ouvir e orientar outras pessoas', 'areas' => ['humanas' => 3, 'saude' => 1]],
                    ['id' => 48, 'texto' => 'Sou mais reservado e introspectivo', 'areas' => ['ciencias' => 2, 'criativa' => 1]]
                ]
            ],
            [
                'id' => 13,
                'texto' => 'Qual causa social mais te interessa?',
                'respostas' => [
                    ['id' => 49, 'texto' => 'Educação e acesso ao conhecimento', 'areas' => ['humanas' => 3, 'ciencias' => 1]],
                    ['id' => 50, 'texto' => 'Saúde pública e bem-estar', 'areas' => ['saude' => 3, 'humanas' => 1]],
                    ['id' => 51, 'texto' => 'Inclusão social e direitos humanos', 'areas' => ['humanas' => 3, 'saude' => 1]],
                    ['id' => 52, 'texto' => 'Sustentabilidade e meio ambiente', 'areas' => ['ciencias' => 3, 'humanas' => 1]]
                ]
            ],
            [
                'id' => 14,
                'texto' => 'O que você acha mais importante em uma carreira?',
                'respostas' => [
                    ['id' => 53, 'texto' => 'Fazer diferença na vida das pessoas', 'areas' => ['humanas' => 3, 'saude' => 1]],
                    ['id' => 54, 'texto' => 'Ganhar bem e ter estabilidade financeira', 'areas' => ['negocios' => 3, 'ciencias' => 1]],
                    ['id' => 55, 'texto' => 'Inovar e criar coisas novas', 'areas' => ['tecnologia' => 3, 'criativa' => 1]],
                    ['id' => 56, 'texto' => 'Ter liberdade criativa e expressão', 'areas' => ['criativa' => 3, 'humanas' => 1]]
                ]
            ],
            [
                'id' => 15,
                'texto' => 'Qual tipo de problema você gosta de resolver?',
                'respostas' => [
                    ['id' => 57, 'texto' => 'Problemas técnicos e tecnológicos', 'areas' => ['tecnologia' => 3, 'ciencias' => 1]],
                    ['id' => 58, 'texto' => 'Problemas sociais e humanos', 'areas' => ['humanas' => 3, 'saude' => 1]],
                    ['id' => 59, 'texto' => 'Problemas de saúde e bem-estar', 'areas' => ['saude' => 3, 'ciencias' => 1]],
                    ['id' => 60, 'texto' => 'Problemas de gestão e estratégia', 'areas' => ['negocios' => 3, 'humanas' => 1]]
                ]
            ]
        ];

        $areas_vocacionais = [
            'tecnologia' => [
                'nome' => 'Tecnologia & Inovação',
                'descricao' => 'Para quem gosta de resolver problemas com lógica, programação e inovação digital.',
                'cor' => '#0ea5e9',
                'carreiras' => [
                    ['nome' => 'Desenvolvedor de Software', 'descricao' => 'Cria aplicações e sistemas usando diferentes linguagens de programação.', 'competencias' => ['Programação', 'Lógica', 'Problem-solving', 'Trabalho em equipe']],
                    ['nome' => 'Engenheiro de Dados', 'descricao' => 'Trabalha com grandes volumes de dados para gerar insights valiosos.', 'competencias' => ['Análise de dados', 'SQL', 'Machine Learning', 'Estatística']],
                    ['nome' => 'Especialista em Cibersegurança', 'descricao' => 'Protege sistemas e dados contra ameaças digitais.', 'competencias' => ['Segurança', 'Redes', 'Análise de riscos', 'Atenção ao detalhe']],
                    ['nome' => 'Arquiteto de Sistemas', 'descricao' => 'Projeta soluções tecnológicas complexas e escaláveis.', 'competencias' => ['Visão estratégica', 'Design de sistemas', 'Liderança técnica']]
                ]
            ],
            'saude' => [
                'nome' => 'Saúde & Bem-estar',
                'descricao' => 'Para quem quer cuidar da saúde e bem-estar das pessoas.',
                'cor' => '#10b981',
                'carreiras' => [
                    ['nome' => 'Médico', 'descricao' => 'Diagnóstico e tratamento de doenças em diversas especialidades.', 'competencias' => ['Conhecimento científico', 'Empatia', 'Tomada de decisão', 'Comunicação']],
                    ['nome' => 'Enfermeiro', 'descricao' => 'Cuida de pacientes e oferece suporte médico e emocional.', 'competencias' => ['Cuidado', 'Paciência', 'Conhecimento técnico', 'Empatia']],
                    ['nome' => 'Psicólogo', 'descricao' => 'Ajuda pessoas a lidar com desafios emocionais e mentais.', 'competencias' => ['Escuta ativa', 'Empatia', 'Análise comportamental', 'Comunicação']],
                    ['nome' => 'Farmacêutico', 'descricao' => 'Trabalha com medicamentos e saúde pública.', 'competencias' => ['Conhecimento químico', 'Atenção ao detalhe', 'Responsabilidade']]
                ]
            ],
            'humanas' => [
                'nome' => 'Humanas & Sociais',
                'descricao' => 'Para quem gosta de trabalhar com pessoas, sociedade, educação e cultura.',
                'cor' => '#a855f7',
                'carreiras' => [
                    ['nome' => 'Professor', 'descricao' => 'Educa e inspira a próxima geração em diversas áreas.', 'competencias' => ['Comunicação', 'Paciência', 'Criatividade', 'Liderança']],
                    ['nome' => 'Assistente Social', 'descricao' => 'Ajuda comunidades e indivíduos a superar desafios sociais.', 'competencias' => ['Empatia', 'Conhecimento social', 'Advocacy', 'Organização']],
                    ['nome' => 'Jornalista', 'descricao' => 'Investiga e comunica histórias importantes para a sociedade.', 'competencias' => ['Pesquisa', 'Escrita', 'Pensamento crítico', 'Comunicação']],
                    ['nome' => 'Historiador', 'descricao' => 'Pesquisa e preserva o conhecimento histórico.', 'competencias' => ['Pesquisa', 'Análise crítica', 'Escrita', 'Atenção ao detalhe']]
                ]
            ],
            'criativa' => [
                'nome' => 'Criativa & Artes',
                'descricao' => 'Para quem quer expressar criatividade e trabalhar com artes e design.',
                'cor' => '#f97316',
                'carreiras' => [
                    ['nome' => 'Designer Gráfico', 'descricao' => 'Cria identidades visuais e materiais de comunicação.', 'competencias' => ['Criatividade', 'Senso estético', 'Ferramentas de design', 'Comunicação visual']],
                    ['nome' => 'Artista Plástico', 'descricao' => 'Expressa-se através de diferentes formas de arte.', 'competencias' => ['Criatividade', 'Técnica artística', 'Visão artística', 'Originalidade']],
                    ['nome' => 'Produtor Audiovisual', 'descricao' => 'Cria conteúdo para vídeo, cinema e plataformas digitais.', 'competencias' => ['Criatividade', 'Técnica audiovisual', 'Storytelling', 'Organização']],
                    ['nome' => 'Arquiteto', 'descricao' => 'Projeta espaços e edifícios funcionais e esteticamente agradáveis.', 'competencias' => ['Criatividade', 'Conhecimento técnico', 'Visão espacial', 'Liderança']]
                ]
            ],
            'negocios' => [
                'nome' => 'Negócios & Administração',
                'descricao' => 'Para quem gosta de liderança, estratégia e desenvolvimento empresarial.',
                'cor' => '#eab308',
                'carreiras' => [
                    ['nome' => 'Gerente de Projetos', 'descricao' => 'Coordena equipes e recursos para alcançar objetivos empresariais.', 'competencias' => ['Liderança', 'Organização', 'Comunicação', 'Resolução de problemas']],
                    ['nome' => 'Analista de Negócios', 'descricao' => 'Analisa mercado e processos para melhorar a performance empresarial.', 'competencias' => ['Análise crítica', 'Comunicação', 'Conhecimento de mercado', 'Atenção ao detalhe']],
                    ['nome' => 'Empreendedor', 'descricao' => 'Cria e desenvolve seu próprio negócio ou startup.', 'competencias' => ['Visão estratégica', 'Resiliência', 'Criatividade', 'Liderança']],
                    ['nome' => 'Consultor Empresarial', 'descricao' => 'Assessora empresas em estratégia e otimização de processos.', 'competencias' => ['Análise', 'Comunicação', 'Experiência empresarial', 'Pensamento crítico']]
                ]
            ],
            'ciencias' => [
                'nome' => 'Ciências & Pesquisa',
                'descricao' => 'Para quem gosta de investigar, pesquisar e descobrir novos conhecimentos.',
                'cor' => '#14b8a6',
                'carreiras' => [
                    ['nome' => 'Pesquisador Científico', 'descricao' => 'Conduz pesquisas para expandir o conhecimento em sua área.', 'competencias' => ['Pensamento crítico', 'Metodologia científica', 'Paciência', 'Análise']],
                    ['nome' => 'Químico', 'descricao' => 'Trabalha com reações químicas e desenvolvimento de novos materiais.', 'competencias' => ['Conhecimento químico', 'Precisão', 'Segurança', 'Análise']],
                    ['nome' => 'Biólogo', 'descricao' => 'Estuda organismos vivos e processos biológicos.', 'competencias' => ['Observação', 'Análise', 'Conhecimento biológico', 'Pesquisa']],
                    ['nome' => 'Físico', 'descricao' => 'Investiga as leis fundamentais da natureza e do universo.', 'competencias' => ['Pensamento abstrato', 'Matemática', 'Análise', 'Criatividade']]
                ]
            ]
        ];

        return ['perguntas' => $perguntas, 'areas' => $areas];
    }

    public function getDicaIA($area, $score) {
if (isset($_GET['ia'])) {
    header('Content-Type: application/json');
    
    $area_principal = $_GET['area'] ?? 'tecnologia';
    $pontuacao = $_GET['score'] ?? 0;
    
    $dicas = [
        'tecnologia' => 'Aprenda programação através de plataformas como Codecademy ou freeCodeCamp. Crie projetos pessoais para seu portfólio!',
        'saude' => 'Explore voluntariados em hospitais ou clínicas. Mantenha-se atualizado com cursos de primeiros socorros e bem-estar.',
        'humanas' => 'Desenvolva habilidades de comunicação e liderança. Participe de grupos de discussão, voluntariados sociais e projetos comunitários.',
        'criativa' => 'Pratique constantemente sua arte. Crie um portfólio online e compartilhe seu trabalho em redes sociais e plataformas criativas.',
        'negocios' => 'Estude administração e empreendedorismo. Acompanhe tendências de mercado e networking profissional.',
        'ciencias' => 'Aprofunde seus conhecimentos em laboratórios e pesquisa. Considere programas de iniciação científica.'
    ];
    
    $dica = $dicas[$area_principal] ?? 'Continue explorando suas aptidões e interesses!';
    
    echo json_encode([
        'sucesso' => true,
        'dica' => $dica,
        'area' => $area_principal
    ]);
    exit;
}
    }
}
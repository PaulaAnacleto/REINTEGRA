<?php

class TesteVocacionalModel {

    private const HF_TOKEN = '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';
    
    // 
    // ***** A CORREÇÃO ESTÁ AQUI *****
    // 
    // Atualizámos a URL base da API conforme a mensagem de erro
    private const HF_API_URL = 'https://router.huggingface.co/hf-inference-instead/models/pierreguillou/gpt2-small-portuguese';

    /**
     * Função principal que tenta buscar a dica na IA e usa o fallback se falhar.
     * (Código de diagnóstico removido)
     */
    public function getDica($area_principal, $pontuacao) {
        try {
            // 1. Criar o prompt (a pergunta) para a IA
            $nome_area = $this->getAreas()[$area_principal]['nome'] ?? $area_principal;
            $prompt = "Você é um conselheiro vocacional. Um estudante fez um teste e a sua área principal foi '$nome_area' com $pontuacao pontos. Dê uma dica curta, prática e inspiradora (em português do Brasil) para ele começar a explorar esta área.";

            // 2. Tentar chamar a IA
            $dicaAI = $this->getDicaRealAI($prompt);
            
            // 3. Se a IA devolver uma dica, mostra-a
            if (!empty($dicaAI)) {
                return $dicaAI;
            }

        } catch (Throwable $e) {
            // Se a chamada falhar (explodir), não faz nada.
            // O código de fallback abaixo será executado.
        }

        // 4. Fallback: Se a IA falhar, usa a dica antiga
        return $this->getDicaFallback($area_principal);
    }


    /**
     * (Corrigido) Tenta contactar a API da IA real.
     * (Código de diagnóstico removido)
     */
    private function getDicaRealAI($prompt) {
        
        // Verificação correta (não falhar se o token for o placeholder)
        if (self::HF_TOKEN === 'COLE_AQUI_SEU_TOKEN_hf_XXXXXXXXXXXXXXXX') {
            return null; // Não tenta se o token não foi configurado
        }

        $payload = json_encode(['inputs' => $prompt, 'options' => ['wait_for_model' => true]]);

        $headers = [
            'Authorization: Bearer ' . self::HF_TOKEN,
            'Content-Type: application/json',
        ];

        $ch = curl_init(self::HF_API_URL); // USA A NOVA URL CORRIGIDA
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 90); // 90 segundos de timeout

        // Manter o SSL desabilitado para testes locais
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Se a chamada falhar OU o código não for 200 OK
        if ($response === false || $http_code != 200) {
            // Falha silenciosamente e deixa o fallback (plano B) assumir
            return null; 
        }

        $data = json_decode($response, true);
        
        if (isset($data[0]['generated_text'])) {
            $dicaLimpa = str_replace($prompt, '', $data[0]['generated_text']);
            return trim($dicaLimpa);
        }

        return null;
    }

    private function getDicaFallback($area_principal) {
        $dicas = [
            'tecnologia' => 'Aprenda programação através de plataformas como Codecademy ou freeCodeCamp. Crie projetos pessoais para seu portfólio!',
            'saude' => 'Explore voluntariados em hospitais ou clínicas. Mantenha-se atualizado com cursos de primeiros socorros e bem-estar.',
            'humanas' => 'Desenvolva habilidades de comunicação e liderança. Participe de grupos de discussão, voluntariados sociais e projetos comunitários.',
            'criativa' => 'Pratique constantemente sua arte. Crie um portfólio online e compartilhe seu trabalho em redes sociais e plataformas criativas.',
            'negocios' => 'Estude administração e empreendedorismo. Acompanhe tendências de mercado e networking profissional.',
            'ciencias' => 'Aprofunde seus conhecimentos em laboratórios e pesquisa. Considere programas de iniciação científica.'
        ];
        
        return $dicas[$area_principal] ?? 'Continue explorando suas aptidões e interesses!';
    }

    
    public function getPerguntas() {
        // (O seu array de perguntas rebalanceadas vai aqui)
        $perguntas = [ //
            [
                'id' => 1,
                'texto' => 'Qual atividade você mais gosta de fazer?',
                'respostas' => [
                    ['id' => 1, 'texto' => 'Resolver problemas com lógica e programação', 'areas' => ['tecnologia' => 3, 'ciencias' => 1]],
                    ['id' => 2, 'texto' => 'Investigar, fazer experimentos e descobrir', 'areas' => ['ciencias' => 3, 'saude' => 1]],
                    ['id' => 3, 'texto' => 'Criar coisas novas e artísticas', 'areas' => ['criativa' => 3, 'tecnologia' => 1]],
                    ['id' => 4, 'texto' => 'Compreender a sociedade, história ou leis', 'areas' => ['humanas' => 3, 'negocios' => 1]]
                ]
            ],
            [
                'id' => 2,
                'texto' => 'Como você prefere trabalhar?',
                'respostas' => [
                    ['id' => 5, 'texto' => 'Colaborando e discutindo ideias com a equipe', 'areas' => ['humanas' => 3, 'negocios' => 1]],
                    ['id' => 6, 'texto' => 'Focado e imerso em um desafio técnico', 'areas' => ['tecnologia' => 3, 'ciencias' => 1]],
                    ['id' => 7, 'texto' => 'Ajudando pessoas a se recuperarem ou melhorarem', 'areas' => ['saude' => 3, 'humanas' => 1]],
                    ['id' => 8, 'texto' => 'Gerenciando recursos e planeando estratégias', 'areas' => ['negocios' => 3, 'tecnologia' => 1]]
                ]
            ],
            [
                'id' => 3,
                'texto' => 'Qual assunto mais te interessa?',
                'respostas' => [
                    ['id' => 9, 'texto' => 'Inovação digital e novas tecnologias', 'areas' => ['tecnologia' => 3, 'ciencias' => 1]],
                    ['id' => 10, 'texto' => 'O corpo humano, saúde e bem-estar', 'areas' => ['saude' => 3, 'ciencias' => 1]],
                    ['id' => 11, 'texto' => 'Arte, design, música e cultura', 'areas' => ['criativa' => 3, 'humanas' => 1]],
                    ['id' => 12, 'texto' => 'Economia, gestão e empreendedorismo', 'areas' => ['negocios' => 3, 'humanas' => 1]]
                ]
            ],
            [
                'id' => 4,
                'texto' => 'Qual é seu maior ponto forte?',
                'respostas' => [
                    ['id' => 13, 'texto' => 'Meu pensamento analítico e lógico', 'areas' => ['ciencias' => 3, 'tecnologia' => 2]],
                    ['id' => 14, 'texto' => 'Minha empatia e habilidade de comunicação', 'areas' => ['humanas' => 3, 'saude' => 1]],
                    ['id' => 15, 'texto' => 'Minha criatividade e visão original', 'areas' => ['criativa' => 3, 'negocios' => 1]],
                    ['id' => 16, 'texto' => 'Minha liderança e capacidade de organização', 'areas' => ['negocios' => 3, 'humanas' => 1]]
                ]
            ],
            [
                'id' => 5,
                'texto' => 'O que mais te motiva no trabalho?',
                'respostas' => [
                    ['id' => 17, 'texto' => 'Resolver desafios complexos e otimizar sistemas', 'areas' => ['tecnologia' => 3, 'ciencias' => 1]],
                    ['id' => 18, 'texto' => 'Cuidar de pessoas e ter um impacto direto na vida delas', 'areas' => ['saude' => 3, 'humanas' => 1]],
                    ['id' => 19, 'texto' => 'Expressar minha visão e criar algo único', 'areas' => ['criativa' => 3, 'humanas' => 1]],
                    ['id' => 20, 'texto' => 'Descobrir algo novo que ninguém sabia antes', 'areas' => ['ciencias' => 3, 'tecnologia' => 1]]
                ]
            ],
            [
                'id' => 6,
                'texto' => 'Como você se vê em 10 anos?',
                'respostas' => [
                    ['id' => 21, 'texto' => 'Especialista em minha área técnica ou científica', 'areas' => ['tecnologia' => 2, 'ciencias' => 2]],
                    ['id' => 22, 'texto' => 'Profissional respeitado na área da saúde', 'areas' => ['saude' => 3, 'ciencias' => 1]],
                    ['id' => 23, 'texto' => 'Criador reconhecido ou diretor de arte', 'areas' => ['criativa' => 3, 'negocios' => 1]],
                    ['id' => 24, 'texto' => 'Líder de uma equipa, ONG ou do meu próprio negócio', 'areas' => ['negocios' => 3, 'humanas' => 2]]
                ]
            ],
            [
                'id' => 7,
                'texto' => 'Qual ambiente de trabalho você prefere?',
                'respostas' => [
                    ['id' => 25, 'texto' => 'Escritório moderno, startup ou empresa de tecnologia', 'areas' => ['tecnologia' => 3, 'negocios' => 1]],
                    ['id' => 26, 'texto' => 'Hospital, clínica ou consultório', 'areas' => ['saude' => 3, 'humanas' => 1]],
                    ['id' => 27, 'texto' => 'Estúdio, agência de design ou redação', 'areas' => ['criativa' => 3, 'humanas' => 1]],
                    ['id' => 28, 'texto' => 'Laboratório ou universidade (pesquisa)', 'areas' => ['ciencias' => 3, 'saude' => 1]]
                ]
            ],
            [
                'id' => 8,
                'texto' => 'Qual tipo de estudo mais te atrai?',
                'respostas' => [
                    ['id' => 29, 'texto' => 'Biologia, química ou física', 'areas' => ['ciencias' => 3, 'saude' => 1]],
                    ['id' => 30, 'texto' => 'Medicina, enfermagem ou psicologia', 'areas' => ['saude' => 3, 'humanas' => 1]],
                    ['id' => 31, 'texto' => 'Direito, história ou filosofia', 'areas' => ['humanas' => 3, 'negocios' => 1]],
                    ['id' => 32, 'texto' => 'Administração, finanças ou economia', 'areas' => ['negocios' => 3, 'ciencias' => 1]]
                ]
            ],
            [
                'id' => 9,
                'texto' => 'Como você lida com problemas?',
                'respostas' => [
                    ['id' => 33, 'texto' => 'Divido em partes menores e analiso com lógica', 'areas' => ['tecnologia' => 3, 'ciencias' => 1]],
                    ['id' => 34, 'texto' => 'Tento entender o lado humano e encontrar um consenso', 'areas' => ['humanas' => 3, 'saude' => 1]],
                    ['id' => 35, 'texto' => 'Busco uma solução criativa e fora do padrão', 'areas' => ['criativa' => 3, 'tecnologia' => 1]],
                    ['id' => 36, 'texto' => 'Analiso os riscos e crio um plano estratégico', 'areas' => ['negocios' => 3, 'humanas' => 1]]
                ]
            ],
            [
                'id' => 10,
                'texto' => 'Qual seria sua maior satisfação profissional?',
                'respostas' => [
                    ['id' => 37, 'texto' => 'Criar uma tecnologia que mude o mundo', 'areas' => ['tecnologia' => 3, 'negocios' => 1]],
                    ['id' => 38, 'texto' => 'Salvar uma vida ou melhorar a saúde de alguém', 'areas' => ['saude' => 3, 'humanas' => 1]],
                    ['id' => 39, 'texto' => 'Defender uma causa ou ensinar algo valioso', 'areas' => ['humanas' => 3, 'criativa' => 1]],
                    ['id' => 40, 'texto' => 'Construir um negócio bem-sucedido a partir do zero', 'areas' => ['negocios' => 3, 'tecnologia' => 1]]
                ]
            ],
            [
                'id' => 11,
                'texto' => 'Qual tipo de impacto social você quer ter?',
                'respostas' => [
                    ['id' => 41, 'texto' => 'Transformar a sociedade através da educação ou justiça', 'areas' => ['humanas' => 3, 'negocios' => 1]],
                    ['id' => 42, 'texto' => 'Melhorar a qualidade de vida através da saúde', 'areas' => ['saude' => 3, 'ciencias' => 1]],
                    ['id' => 43, 'texto' => 'Contribuir para avanços científicos e descobertas', 'areas' => ['ciencias' => 3, 'tecnologia' => 1]],
                    ['id' => 44, 'texto' => 'Inspirar pessoas através da arte e da cultura', 'areas' => ['criativa' => 3, 'humanas' => 1]]
                ]
            ],
            [
                'id' => 12,
                'texto' => 'No seu tempo livre, você prefere...',
                'respostas' => [
                    ['id' => 45, 'texto' => 'Aprender uma nova habilidade (ex: programar, investir)', 'areas' => ['tecnologia' => 2, 'negocios' => 2]],
                    ['id' => 46, 'texto' => 'Ir a museus, concertos ou desenhar', 'areas' => ['criativa' => 3, 'humanas' => 1]],
                    ['id' => 47, 'texto' => 'Ler sobre ciência ou assistir documentários', 'areas' => ['ciencias' => 3, 'tecnologia' => 1]],
                    ['id' => 48, 'texto' => 'Conversar, debater ideias e entender pessoas', 'areas' => ['humanas' => 3, 'negocios' => 1]]
                ]
            ],
            [
                'id' => 13,
                'texto' => 'Qual causa social mais te interessa?',
                'respostas' => [
                    ['id' => 49, 'texto' => 'Educação e acesso ao conhecimento', 'areas' => ['humanas' => 3, 'ciencias' => 1]],
                    ['id' => 50, 'texto' => 'Saúde pública e bem-estar', 'areas' => ['saude' => 3, 'humanas' => 1]],
                    ['id' => 51, 'texto' => 'Sustentabilidade e combate às mudanças climáticas', 'areas' => ['ciencias' => 3, 'humanas' => 1]],
                    ['id' => 52, 'texto' => 'Inovação tecnológica para inclusão social', 'areas' => ['tecnologia' => 3, 'humanas' => 1]]
                ]
            ],
            [
                'id' => 14,
                'texto' => 'O que você acha mais importante em uma carreira?',
                'respostas' => [
                    ['id' => 53, 'texto' => 'Ter um propósito e fazer diferença na vida das pessoas', 'areas' => ['humanas' => 3, 'saude' => 2]],
                    ['id' => 54, 'texto' => 'Crescimento financeiro e estabilidade', 'areas' => ['negocios' => 3, 'tecnologia' => 1]],
                    ['id' => 55, 'texto' => 'Desafios intelectuais e inovação constante', 'areas' => ['tecnologia' => 2, 'ciencias' => 2]],
                    ['id' => 56, 'texto' => 'Ter liberdade criativa e de expressão', 'areas' => ['criativa' => 3, 'humanas' => 1]]
                ]
            ],
            [
                'id' => 15,
                'texto' => 'Qual tipo de problema você gosta de resolver?',
                'respostas' => [
                    ['id' => 57, 'texto' => 'Problemas científicos ou de investigação', 'areas' => ['ciencias' => 3, 'saude' => 1]],
                    ['id' => 58, 'texto' => 'Problemas sociais, éticos ou humanos', 'areas' => ['humanas' => 3, 'negocios' => 1]],
                    ['id' => 59, 'texto' => 'Problemas estéticos ou de comunicação visual', 'areas' => ['criativa' => 3, 'negocios' => 1]],
                    ['id' => 60, 'texto' => 'Problemas de gestão, estratégia e otimização', 'areas' => ['negocios' => 3, 'tecnologia' => 1]]
                ]
            ]
        ];
        return $perguntas;
    }
    
    public function getAreas() {
        // (O seu array de áreas vai aqui)
        $areas_vocacionais = [ //
            'tecnologia' => [ //
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
            'saude' => [ //
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
            'humanas' => [ //
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
            'criativa' => [ //
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
            'negocios' => [ //
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
            'ciencias' => [ //
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
        return $areas_vocacionais;
    }
}
?>
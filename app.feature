Funcionalidade: Página de Currículo
  Como um usuário,
  Eu quero visitar a página de currículo
  Para ver dicas sobre como montar meu CV

  Contexto: O usuário está na página de currículo
    Dado que eu abro a página de "curriculo.html"

  Cenário: Visualizar o título principal da página
    Quando eu olho para a seção principal
    Então eu devo ver o título "CURRÍCULO PROFISSIONAL"

  Cenário: Visualizar os cards de dicas
    Quando eu rolo a página para baixo
    Então eu devo ver um card com o título "Escolha um Formato Claro e Profissional"
    E eu devo ver um card com o título "Informações de Contato"
    E eu devo ver um total de 9 cards de dicas

  Cenário: Navegação em modo mobile
    Dado que eu estou usando um celular "iphone-6"
    Quando eu clico no botão de menu hamburguer
    Então o menu de navegação deve se tornar visível
    E eu devo ver o link "Serviços"

Funcionalidade: Página de Vagas
  Como usuário, eu quero que a página de vagas carregue corretamente,
  mostre os links corretos e seja responsiva,
  para que eu possa encontrar oportunidades de emprego.

  Cenário: Carregamento do conteúdo principal
    Dado que eu visito a página de Vagas
    Então eu devo ver o título da página "Vagas - Reintegra"
    E eu devo ver o título principal "VAGAS"
    E eu devo ver o logo "REINTEGRA" na barra de navegação
    E eu devo ver todos os 6 cards de sites de vagas
    E eu devo ver o texto de copyright "© 2025 Reintegra."

  Cenário: Verificação dos links dos cards de vagas
    Dado que eu visito a página de Vagas
    Então o card "Indeed" deve ter o link "https://br.indeed.com/" e abrir em nova aba
    E o card "Infojobs" deve ter o link "https://www.infojobs.com.br/" e abrir em nova aba
    E o card "Catho" deve ter o link "https://www.catho.com.br/" e abrir em nova aba

  Cenário: Responsividade Mobile (Navbar)
    Dado que eu visito a página de Vagas em um celular
    Então eu devo ver o ícone de perfil móvel
    E eu não devo ver o ícone de perfil desktop
    Quando eu clico no botão "hamburguer"
    Então o menu de navegação deve ser exibido

  Cenário: Acessibilidade e Interações
    Dado que eu visito a página de Vagas
    Então eu devo ver o botão de acesso do VLibras
    E eu devo ver o botão "Voltar"
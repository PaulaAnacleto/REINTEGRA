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
Feature: Testes da Página Inicial - Reintegra
  Como usuário do site Reintegra
  Quero acessar e interagir com a página inicial
  Para verificar que todos os elementos funcionam corretamente

  Background:
    Dado que estou na página "Inicial-login.php"

  1. Teste de carregamento da página
  Scenario: Carregar a página e exibir título e cabeçalho corretos
    Então o título da página deve ser "Reintegra - Reintegrando sua vida por completo"
    E o elemento "h1.hero-title" deve estar visível
    E o texto do h1 deve conter "Reintegrando sua vida por completo"

  2. Navegação (Desktop)
  Scenario: Exibir links de navegação e ícone de perfil (Desktop)
    Dado que estou com viewport "1920x1080"
    Então os links "Serviços", "Feedback", "Contato", "Sobre" e "Início" devem estar visíveis na navbar
    E o botão de perfil desktop deve estar visível
    E o botão de perfil mobile não deve estar visível

  Scenario: Rolar até a seção correta ao clicar nos links âncora (Desktop)
    Dado que estou com viewport "1920x1080"
    Quando eu clicar no link "Sobre"
    Então devo ver a seção "sobre" visível
    Quando eu clicar no link "Feedback"
    Então devo ver a seção "cadastro" visível

  Scenario: Adicionar sombra ao navbar ao rolar a página
    Então a navbar não deve ter a classe "shadow"
    Quando eu rolar a página para baixo
    Então a navbar deve ter a classe "shadow"
    Quando eu rolar de volta ao topo
    Então a navbar não deve ter a classe "shadow"

  3. Formulário de Feedback
  Scenario: Enviar feedback válido e receber mensagem de sucesso
    Dado que o servidor responde com sucesso ao envio do feedback
    Quando eu digitar "Testando o formulário de feedback com Cypress!" no campo de feedback
    E eu clicar no botão de enviar feedback
    Então deve aparecer uma mensagem de sucesso contendo "Obrigado pelo seu feedback!"
    E o campo de feedback deve ser limpo

  4. Navegação (Mobile)
  Scenario: Exibir ícone de perfil e menu hamburguer no modo mobile
    Dado que estou com viewport "iPhone 6"
    Então o botão de perfil mobile deve estar visível
    E o botão de perfil desktop não deve estar visível
    E o menu hamburguer deve estar visível

  Scenario: Abrir e fechar o menu mobile
    Dado que estou com viewport "iPhone 6"
    E o menu mobile está fechado
    Quando eu clicar no botão do menu hamburguer
    Então o menu deve estar visível
    Quando eu clicar no item "Sobre"
    Então o menu mobile deve ser fechado

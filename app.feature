Feature: Terms of Service - REINTEGRA

    Given I open the Terms of Service page at "http://localhost/reintegra/view/Termos-servico.php"

  Scenario: Page loads and has correct title and header
    Then the page title should contain "Termos de Serviço"
    And the header should contain the text "Termos de" and be visible

  Scenario: Shows latest update date
    Then I should see "Última atualização: 14 de outubro de 2025" within ".update-date"

  Scenario: Back button exists and calls history.back when clicked
    When I stub the window.history.back function
    And I click the back button ".back-button"
    Then the window.history.back should have been called

  Scenario: Contact links have correct hrefs and tooltip
    Then the contact links under ".contact-info a" should contain mailto, tel and wa.me links
    And each contact link should have a title attribute "Clique para entrar em contato"

  Scenario: Footer contains a privacy link
    Then the footer should have a link ".footer-link" that contains text "Política de Privacidade" and an href attribute

  Scenario: Content sections are present
    Then the page should contain headings for sections like "1. Aceitação dos Termos" and "12. Lei Aplicável"
Feature: Tutorials and Tips Page - Reintegra

Scenario: Load the page correctly
Given the user accesses "http://localhost/REINTEGRA-1/view/tutoriais-dicas.php"
Then the page title should be "Tutoriais e Dicas - Reintegra"

Scenario: Display main title and description
Given the page has loaded
Then it should display the title "TUTORIAIS E DICAS"
And it should contain the description with the text "Descubra conteúdos práticos"

Scenario: Display main cards
Given the user is on the Tutorials and Tips page
Then there should be at least 3 cards with the following titles:
| Title                             |
| Monte seu Currículo               |
| Domine a Entrevista               |
| Aproveitando o Poder do Networking |

Scenario: Verify action buttons
Given the user views the cards
Then each card should have a visible button with the text "Começar"
And all buttons should have the class ".btn-primary"

Scenario: Validate card internal content
Given the user checks the displayed cards
Then each card should contain a visible image
And it should include a list of topics

Scenario: Check navigation bar links
Given the user views the page navbar
Then there should be visible links for "Serviços", "Contato", and "Início"
Feature: Página Entrevista - Reintegra
        Given I access the interview page at "http://localhost/reintegra/View/Entrevista.php"

        Scenario: Load the page
        Then the main title "JOB INTERVIEW" should be visible
        And the main description should contain "Be yourself"

        Scenario: Navbar contains links
        Then the navigation bar should contain at least 4 links
        And there should be a link "Services"
        And there should be a link "Contact"
        And there should be a link "Home"

        Scenario: Display 4 cards
        Then there should be 4 cards with the class ".card-item"
        And each card should have a visible, non-empty title
        And each card should have a visible image with the alt attribute defined

        Scenario: Back button present
        Then the back button with class ".back-button" should exist
        And it should have the aria-label attribute with value "Back"Feature: Networking - Reintegra
    Given I visit "http://localhost/reintegra/view/Networking.php"

  Scenario: Page loads with the correct title
    Then the page title should be "Networking - Reintegra"

  Scenario: Display navbar with logo, links, and profile icon (desktop)
    When I set the viewport to 1280x720
    Then the navbar should be visible
    And the logo text should contain "REINTEGRA"
    And the navbar should contain the links "Services", "Feedback", "Contact", "About", and "Home"
    And the profile button for large screens should be visible
    And the profile button for small screens should not be visible

  Scenario: Hero section with title and back button
    Then the hero section should be visible
    And the main title should be "NETWORKING"
    And there should be a visible back button with aria-label "Back"
    And the back icon should have alt text "Back"

  Scenario: Toggle of "reverse" class in cards
    Then the card at index 0 should not have the class "reverse"
    And the card at index 1 should have the class "reverse"
    And the card at index 2 should not have the class "reverse"
    And the card at index 3 should have the class "reverse"

  Scenario: Load the VLibras accessibility widget
    Then the element "div[vw].enabled" should be visible
    And the element "div[vw-access-button].active" should be visible
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

Funcionalidade: Cadastro de Usuário - REINTEGRA
  Como um novo usuário,
  Eu quero me cadastrar na plataforma
  Para ter acesso aos serviços.

  Contexto: O usuário está na página de cadastro
    Dado que eu estou na página de cadastro
    E eu preparei um mock para os alertas do navegador

  Cenário: Tentativa de cadastro com campos obrigatórios vazios
    Quando eu clico no botão "Cadastre-se"
    E eu toco e saio do campo "Nome completo"
    Então eu devo ver a mensagem de erro "Nome completo é obrigatório" para o campo "Nome completo"
    Quando eu toco e saio do campo "Email"
    Então eu devo ver a mensagem de erro "Email é obrigatório" para o campo "Email"
    Quando eu toco e saio do campo "Senha"
    Então eu devo ver a mensagem de erro "Senha é obrigatória" para o campo "Senha"
    Quando eu toco e saio do campo "Confirmação de senha"
    Então eu devo ver a mensagem de erro "Confirmação de senha é obrigatória" para o campo "Confirmação de senha"

  Esquema do Cenário: Validação de campos individuais com dados inválidos
    Quando eu preencho o campo <campo> com <valor> e saio
    Então eu devo ver a mensagem de erro <mensagem> para o campo <campo>

    Exemplos:
      | campo                 | valor             | mensagem                                                                                  |
      | "Nome completo"       | "Helber"          | "Digite seu nome completo (nome e sobrenome)"                                             |
      | "Email"               | "email-invalido"  | "Digite um email válido"                                                                  |
      | "Senha"               | "Pass123"         | "Senha deve ter pelo menos 8 caracteres, incluindo maiúscula, minúscula e número"       |
      | "Confirmação de senha"| "Password2"       | "As senhas não coincidem"                                                                 |

  Esquema do Cenário: Validação de campos individuais com dados válidos
    Quando eu preencho o campo "Senha" com "Password1"
    E eu preencho o campo <campo> com <valor> e saio
    Então o campo <campo> deve ser marcado como "success"

    Exemplos:
      | campo                 | valor                |
      | "Nome completo"       | "Helber Luiz"        |
      | "Email"               | "helber@example.com" |
      | "Senha"               | "Password1"          |
      | "Confirmação de senha"| "Password1"          |

  Cenário: Cadastro bem-sucedido
    Dado que eu uso o relógio simulado do Cypress
    Quando eu preencho o formulário de cadastro com dados válidos
    E eu clico no botão "Cadastre-se"
    Então o botão "Cadastre-se" deve estar desabilitado e mostrar "Cadastrando..."
    Quando eu avanço o relógio em 2 segundos
    Então eu devo ver o alerta "Cadastro realizado com sucesso! Bem-vindo ao REINTEGRA!"
    E o formulário deve ser limpo
    E os campos não devem ter marcas de "success" ou "error"
    And o botão "Cadastre-se" deve estar habilitado e mostrar "Cadastre-se"

  Cenário: Botão "Saiba mais"
    Quando eu clico no botão "Saiba mais"
    Então eu devo ver um alerta contendo "Descubra oportunidades incríveis de emprego com o REINTEGRA"
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
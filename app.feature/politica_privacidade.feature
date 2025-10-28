Feature: Política de Privacidade - REINTEGRA

    Given I open the Política de Privacidade page at "http://localhost/reintegra/view/Politica-privacidade.php"

  Scenario: Página carrega e exibe o título correto
    Then the page title should contain "Política de Privacidade"
    And the header should contain the text "Política de"
    And the header should be visible

  Scenario: Exibe a data de última atualização esperada
    Then I should see the text "Última atualização: 14 de outubro de 2025" within ".update-date"

  Scenario: Botão de voltar existe e possui atributos
    Then the back button ".back-button" should exist
    And the back button should have attribute "aria-label" with value "Voltar"
    And the back button image ".back-button .back-icon" should have alt text "Voltar"

  Scenario: Botão de voltar chama history.back() ao clicar
    When I stub the window.history.back function
    And I click the back button ".back-button"
    Then the window.history.back should have been called

  Scenario: Possui link no footer para termos de serviço
    Then the footer should contain a link ".footer-link" with href containing "termos-servico.php"

  Scenario: Link de termos de serviço redireciona para a página correta
    When I click the footer link ".footer-link"
    Then the current URL should include "termos-servico.php"

  Scenario: Insere estilos de impressão com @media print
    Then the document head should contain a style tag including "@media print"
    And the print styles should hide ".back-button" (contain "display: none")

  Scenario: Links de contato possuem title
    Then each contact link under ".contact-info a" should have attribute "title" with value "Clique para entrar em contato"

  Scenario: Destaque de seção ao rolar aplica transform
    When I scroll to the first heading inside ".content h2"
    Then the first ".content h2" should have inline style containing "translateX(5px)"

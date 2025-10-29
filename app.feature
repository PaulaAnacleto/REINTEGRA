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

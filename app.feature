Feature: Login - REINTEGRA
  Validate the main behaviors of the login page.

    Given I open the login page at "http://localhost/reintegra/view/Login.php"

  Scenario: Page loads and displays main elements
    Then the page title should contain "Login - REINTEGRA"
    And the form header "Entrar" should be visible
    And the signup link ".signup-link" should contain the href "Cadastro.php"
    And the submit button ".submit-btn" should exist and contain the text "Entrar"
    And the fields "#email" and "#senha" should exist

  Scenario: Required fields show errors when empty
    When I focus and blur "#email"
    And I focus and blur "#senha"
    And I submit the form "#loginForm"
    Then the group for field "#email" should display the message "Email é obrigatório"
    And the group for field "#senha" should display the message "Senha é obrigatória"

  Scenario: Invalid email shows error message
    When I fill "#email" with "email-invalido" and blur
    Then the group for field "#email" should display the message "Digite um email válido"
    And the wrapper for "#email" should have the class "error"

  Scenario: Short password shows error message
    When I fill "#senha" with "123" and blur
    Then the group for field "#senha" should display the message "Senha deve ter pelo menos 6 caracteres"
    And the wrapper for "#senha" should have the class "error"

  Scenario: Valid fields receive success class
    When I fill "#email" with "usuario@example.com" and blur
    And I fill "#senha" with "senhaSegura" and blur
    Then the wrappers for "#email" and "#senha" should have the class "success"

  Scenario: "Learn more" button is inside a link to index
    Then the button ".learn-more-btn" should exist
    And its closest ancestor <a> should have an href that contains "index.php"
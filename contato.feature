Feature: Contact Page and Legal Links

  As a user,
  I want to see the contact options and links to the company's policies,
  So that I can get in touch or obtain legal information.

  Scenario: Visualize the main elements of the Contact page
    Given the user is on the Contact page
    Then they should see the title "How do you prefer to talk to us?"
    And they should see the "Back" button with the arrow icon
    And they should see the three contact options: "E-mail", "Phone" and "Whatsapp"
    And each contact option should have an icon, a title, and a contact link
    And the E-mail link should be "mailto:reintegracontato@gmail.com"
    And the Phone link should be "tel:08007866890"
    And the Whatsapp link should be "https://wa.me/5571993105092"
    And they should see the copyright text "© 2025 Reintegra. All rights reserved."
    And they should see the "Política de Privacidade" link
    And they should see the "Termos de Serviço" link

  Scenario: Redirection to E-mail
    Given the user is on the Contact page
    When they click on the E-mail link
    Then the system should attempt to open the email client with the address "reintegracontato@gmail.com"

  Scenario: Redirection to Phone
    Given the user is on the Contact page
    When they click on the Phone link
    Then the system should attempt to initiate a call to "08007866890"

  Scenario: Redirection to WhatsApp
    Given the user is on the Contact page
    When they click on the Whatsapp link
    Then the system should redirect to the WhatsApp link "https://wa.me/5571993105092"

  Scenario: Navigation to Privacy Policy
    Given the user is on the Contact page
    When they click on the "Política de Privacidade" link in the footer
    Then they should be redirected to the page "../View/Politica-privacidade"

  Scenario: Navigation to Terms of Service
    Given the user is on the Contact page
    When they click on the "Termos de Serviço" link in the footer
    Then they should be redirected to the page "../View/Termos-servico"
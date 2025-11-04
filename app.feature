Feature: Networking - Reintegra
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

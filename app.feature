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
        And it should have the aria-label attribute with value "Back"
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

describe('Contact Page Navigation Tests', () => {

  beforeEach(() => {
   
    cy.visit('http://localhost/REINTEGRA/View/Contato.php'); 
  });

  it('deve navegar para a Política de Privacidade', () => {
    cy.get('.footer-link').contains('Política de Privacidade').click();
    
    cy.url().should('include', '../View/Politica-privacidade.php');
  });

  it('deve navegar para os Termos de Serviço', () => {
    cy.get('.footer-link').contains('Termos de Serviço').click();

    cy.url().should('include', '../View/Termos-servico.php');
  });
});
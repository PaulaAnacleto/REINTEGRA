describe('Contact Page Navigation Tests', () => {

  // Antes de cada teste, visite a página de contato
  beforeEach(() => {
    // *** IMPORTANTE: Substitua 'caminho/para/sua/pagina/contato.html' pelo caminho real do seu arquivo ***
    cy.visit('caminho/para/sua/pagina/contato.html'); 
  });

  it('deve navegar para a Política de Privacidade', () => {
    // 1. Encontra o link que contém o texto 'Política de Privacidade'
    // 2. Clica no link
    cy.get('.footer-link').contains('Política de Privacidade').click();
    
    // 3. Verifica se a URL foi alterada para incluir o caminho de destino
    // O caminho é baseado no 'href' do seu HTML: "../View/Politica-privacidade"
    cy.url().should('include', '../View/Politica-privacidade.php');
  });

  it('deve navegar para os Termos de Serviço', () => {
    // 1. Encontra o link que contém o texto 'Termos de Serviço'
    // 2. Clica no link
    cy.get('.footer-link').contains('Termos de Serviço').click();
    
    // 3. Verifica se a URL foi alterada para incluir o caminho de destino
    // O caminho é baseado no 'href' do seu HTML: "../View/Termos-servico"
    cy.url().should('include', '../View/Termos-servico.php');
  });
});
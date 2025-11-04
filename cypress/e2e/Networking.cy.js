describe('Teste da Página de Currículo - Reintegra', () => {
  beforeEach(() => {
    cy.visit('http://localhost/reintegra/view/Networking.php');
  });

  it('Deve carregar a página e ter o título correto', () => {
    cy.title().should('eq', 'Networking - Reintegra');
  });

  it('Deve exibir a navbar com logo, links e ícone de perfil (desktop)', () => {
    cy.viewport(1280, 720);

    cy.get('.navbar').should('be.visible');
    cy.get('.logo-text').should('contain.text', 'REINTEGRA');
    cy.get('#navbarNav').within(() => {
      cy.contains('a.nav-link', 'Serviços').should('be.visible');
      cy.contains('a.nav-link', 'Feedback').should('be.visible');
      cy.contains('a.nav-link', 'Contato').should('be.visible');
      cy.contains('a.nav-link', 'Sobre').should('be.visible');
      cy.contains('a.nav-link', 'Início').should('be.visible');
    });

    cy.get('.d-lg-none .btn-perfil').should('not.be.visible');
    cy.get('.nav-item.d-none.d-lg-block .btn-perfil').should('be.visible');
  });

  it('Deve exibir a seção hero com título e botão de voltar', () => {
    cy.get('.hero-section').should('be.visible');
    cy.contains('h1.hero-title', 'NETWORKING').should('be.visible');
    cy.get('.back-button').should('be.visible').and('have.attr', 'aria-label', 'Voltar');
    cy.get('.back-icon').should('have.attr', 'alt', 'Voltar');
  });

  it('Deve alternar o layout dos cards com a classe "reverse"', () => {
    cy.get('.card-item').eq(0).should('not.have.class', 'reverse');
    cy.get('.card-item').eq(1).should('have.class', 'reverse');
    cy.get('.card-item').eq(2).should('not.have.class', 'reverse');
    cy.get('.card-item').eq(3).should('have.class', 'reverse');
  });

  it('Deve carregar o widget de acessibilidade VLibras', () => {
    cy.get('div[vw].enabled').should('be.visible');
    cy.get('div[vw-access-button].active').should('be.visible');
  });

});
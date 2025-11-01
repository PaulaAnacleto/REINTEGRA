describe('Testes de Front-End da Página de Vagas', () => {

  beforeEach(() => {
    cy.visit('/View/Vagas.php');
  });

  context('Carregamento e Conteúdo Principal', () => {
    it('deve carregar o título da página e o título principal (H1)', () => {
      cy.title().should('eq', 'Vagas - Reintegra');
      cy.get('.hero-title')
        .should('be.visible')
        .and('contain.text', 'VAGAS');
      cy.get('.hero-description')
        .should('be.visible')
        .and('not.be.empty');
    });

    it('deve exibir o logo "REINTEGRA" na navbar', () => {
      cy.get('.logo-text')
        .should('be.visible')
        .and('contain.text', 'REINTEGRA');
    });

    it('deve exibir todos os 6 cards de sites de vagas', () => {
      cy.get('.content-section .card-item').should('have.length', 6);
    });

    it('deve exibir o texto de copyright no footer', () => {
      cy.get('.footer-text')
        .should('be.visible')
        .and('contain.text', '© 2025 Reintegra.');
    });
  });

  context('Links dos Cards de Vagas', () => {
    it('deve ter o link correto para o Indeed', () => {
      cy.contains('.card-title', 'Indeed') 
        .parents('.card-text') 
        .find('a') 
        .should('have.attr', 'href', 'https://br.indeed.com/')
        .and('have.attr', 'target', '_blank');
    });

    it('deve ter o link correto para o Infojobs', () => {
      cy.contains('.card-title', 'Infojobs')
        .parents('.card-text')
        .find('a')
        .should('have.attr', 'href', 'https://www.infojobs.com.br/')
        .and('have.attr', 'target', '_blank');
    });

    it('deve ter o link correto para a Catho', () => {
      cy.contains('.card-title', 'Catho')
        .parents('.card-text')
        .find('a')
        .should('have.attr', 'href', 'https://www.catho.com.br/')
        .and('have.attr', 'target', '_blank');
    });
  });

  context('Responsividade (Mobile)', () => {
    beforeEach(() => {
      cy.viewport('iphone-6');
    });

    it('deve exibir o ícone de perfil móvel e esconder o de desktop', () => {
      cy.get('.d-lg-none .btn-perfil').should('be.visible');
      cy.get('.d-none.d-lg-block .btn-perfil').should('not.be.visible');
    });

    it('deve exibir o menu de navegação ao clicar no botão "hamburguer"', () => {
      cy.contains('.nav-link', 'Serviços').should('not.be.visible');
      cy.get('.navbar-toggler').click();
      cy.contains('.nav-link', 'Serviços').should('be.visible');
    });
  });
  context('Acessibilidade', () => {
    it('deve exibir o botão de acesso do VLibras', () => {
      cy.get('[vw-access-button]').should('be.visible');
    });
  });
  context('Interações do Usuário', () => {
    it('deve ter um botão "Voltar" visível', () => {
      cy.get('.back-button')
        .should('be.visible')
        .and('have.attr', 'aria-label', 'Voltar');
    });
  });

});
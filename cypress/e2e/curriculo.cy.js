describe('Teste da Página de Currículo - Reintegra', () => {

  // Antes de cada teste, visita a página de currículo
  beforeEach(() => {
    cy.visit('/Curriculo.php');
  });

  /**
   * Teste 1: Verifica o carregamento básico e o título da página
   */
  it('Deve carregar a página e ter o título correto', () => {
    cy.title().should('eq', 'Currículo - Reintegra');
  });

  /**
   * Teste 2: Verifica a Navbar (visão Desktop)
   */
  it('Deve exibir a navbar com logo, links e ícone de perfil (desktop)', () => {
    // Define o viewport para garantir que estamos em "desktop"
    cy.viewport(1280, 720);

    cy.get('.navbar').should('be.visible');
    cy.get('.logo-text').should('contain.text', 'REINTEGRA');

    // Verifica os links dentro da navbar
    cy.get('#navbarNav').within(() => {
      cy.contains('a.nav-link', 'Serviços').should('be.visible');
      cy.contains('a.nav-link', 'Feedback').should('be.visible');
      cy.contains('a.nav-link', 'Contato').should('be.visible');
      cy.contains('a.nav-link', 'Sobre').should('be.visible');
      cy.contains('a.nav-link', 'Início').should('be.visible');
    });

    // Na visão desktop, o ícone de perfil mobile deve estar oculto
    cy.get('.d-lg-none .btn-perfil').should('not.be.visible');
    
    // E o ícone de perfil desktop deve estar visível
    cy.get('.nav-item.d-none.d-lg-block .btn-perfil').should('be.visible');
  });

  /**
   * Teste 3: Verifica a seção Hero (título e botão de voltar)
   */
  it('Deve exibir a seção hero com título e botão de voltar', () => {
    cy.get('.hero-section').should('be.visible');
    
    // Verifica o título principal
    cy.contains('h1.hero-title', 'CURRÍCULO PROFISSIONAL').should('be.visible');
    
    // Verifica o botão de voltar
    cy.get('.back-button').should('be.visible').and('have.attr', 'aria-label', 'Voltar');
    cy.get('.back-icon').should('have.attr', 'alt', 'Voltar');
  });

  /**
   * Teste 4: Verifica o conteúdo dos cards
   */
  it('Deve exibir todos os 9 cards de conteúdo e os separadores', () => {
    cy.get('.content-section').should('be.visible');
    
    // Verifica o número total de cards
    cy.get('.card-item').should('have.length', 9);

    // Verifica os títulos separadores
    cy.contains('h1.hero-title', 'OPICIONAL').should('be.visible');
    cy.contains('h1.hero-title', 'DICAS FINAIS').should('be.visible');

    // Verifica o conteúdo do primeiro card
    cy.get('.card-item').first().within(() => {
      cy.contains('.card-title', 'Escolha um Formato Claro e Profissional');
      cy.get('img').should('have.attr', 'alt', 'Ilustração de currículo');
    });

    // Verifica o conteúdo do último card
    cy.get('.card-item').last().within(() => {
      cy.contains('.card-title', 'Dicas');
      cy.get('img').should('have.attr', 'alt', 'Revisão final');
    });
  });

  /**
   * Teste 5: Verifica o layout alternado (classe 'reverse')
   */
  it('Deve alternar o layout dos cards com a classe "reverse"', () => {
    // Card 1 (índice 0) - NÃO deve ter 'reverse'
    cy.get('.card-item').eq(0).should('not.have.class', 'reverse');
    
    // Card 2 (índice 1) - DEVE ter 'reverse'
    cy.get('.card-item').eq(1).should('have.class', 'reverse');
    
    // Card 3 (índice 2) - NÃO deve ter 'reverse'
    cy.get('.card-item').eq(2).should('not.have.class', 'reverse');

    // Card 4 (índice 3) - DEVE ter 'reverse'
    cy.get('.card-item').eq(3).should('have.class', 'reverse');
  });

  /**
   * Teste 6: Verifica a visão Mobile e o menu hamburguer
   */
  it('Deve exibir o ícone de perfil móvel e o menu hamburguer no mobile', () => {
    // Seta o viewport para um tamanho de celular
    cy.viewport('iphone-6'); 
    
    // Ícone de perfil (desktop) não deve estar visível
    cy.get('.nav-item.d-none.d-lg-block').should('not.be.visible');
    
    // Ícone de perfil (mobile) deve estar visível
    cy.get('.d-lg-none .btn-perfil').should('be.visible');

    // Botão toggler (hamburguer) deve estar visível
    cy.get('.navbar-toggler').should('be.visible').click();

    // Após o clique, o menu (navbarNav) deve ficar visível
    cy.get('#navbarNav').should('be.visible');
    cy.contains('a.nav-link', 'Serviços').should('be.visible');
  });

  /**
   * Teste 7: Verifica o widget de acessibilidade VLibras
   */
  it('Deve carregar o widget de acessibilidade VLibras', () => {
    cy.get('div[vw].enabled').should('be.visible');
    cy.get('div[vw-access-button].active').should('be.visible');
  });

});
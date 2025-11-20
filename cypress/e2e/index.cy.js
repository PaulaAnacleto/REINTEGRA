describe('Teste da Landing Page - Reintegra', () => {

  // Antes de cada teste, visita a página principal
  beforeEach(() => {
    // Ajuste o cy.visit() para o caminho correto do seu arquivo.
    // Se estiver rodando um servidor local, use 'http://localhost:PORTA'
    cy.visit('/index.php');
  });

  /**
   * Teste 1: Verifica o carregamento básico e o título da página
   */
  it('Deve carregar a página e ter o título correto', () => {
    cy.title().should('eq', 'Reintegra - Reintegrando sua vida por completo');
  });

  /**
   * Teste 2: Verifica os elementos da Barra de Navegação (Navbar)
   */
  it('Deve exibir a navbar com o logo e os links corretos', () => {
    // Verifica o logo
    cy.get('.navbar-brand').should('be.visible');
    cy.get('.logo-text').should('contain.text', 'REINTEGRA');

    // Verifica os links de navegação
    cy.get('#navbarNav').within(() => {
      cy.contains('a.nav-link', 'Serviços').should('have.attr', 'href', '../view/Servicos.php');
      cy.contains('a.nav-link', 'Contato').should('have.attr', 'href', '../view/Contato.php');
      cy.contains('a.nav-link', 'Sobre').should('have.attr', 'href', '#sobre');
      cy.contains('a.nav-link', 'Entrar').should('have.attr', 'href', '../view/Login.php');
      cy.contains('a.nav-link', 'Cadastre-se').should('have.attr', 'href', '../view/Cadastro.php');
    });
  });

  /**
   * Teste 3: Verifica o conteúdo da seção Hero
   */
  it('Deve exibir o conteúdo da seção Hero', () => {
    cy.get('#inicio.hero-section').should('be.visible');
    cy.get('.hero-title').should('contain.text', 'Reintegrando sua vida por completo');
    cy.get('.hero-text').should('contain.text', 'ex-trabalhadores da Ford');
    cy.get('.hero-image').should('be.visible').and('have.attr', 'alt', 'Casa com painéis solares');
  });

  /**
   * Teste 4: Verifica o conteúdo da seção "Sobre"
   */
  it('Deve exibir o conteúdo da seção Sobre o Reintegra', () => {
    cy.get('#sobre.sobre-section').should('be.visible');
    cy.contains('h2.section-title', 'Sobre o Reintegra');
    cy.contains('.section-text', 'mercado de trabalho de Camaçari');

    // Verifica os ícones de features
    cy.contains('.feature-title', 'Objetivo');
    cy.contains('.feature-title', 'Fidelidade');
    cy.contains('.feature-title', 'Qualidade');
    cy.contains('.feature-title', 'Inovação');

    // Verifica a imagem e o selo
    cy.get('.sobre-image').should('be.visible');
    cy.get('.badge-seguro').should('contain.text', '100% Seguro');
  });

  /**
   * Teste 5: Verifica a seção de Feedbacks
   */
  it('Deve exibir 3 cards de feedback', () => {
    cy.get('#feedbacks.feedbacks-section').should('be.visible');
    cy.contains('h2.section-title', 'Feedbacks');

    // Verifica se existem 3 cards
    cy.get('.feedback-card').should('have.length', 3);

    // Verifica o conteúdo de um card específico
    cy.contains('.feedback-name', 'Mariana Santos');
    cy.contains('.feedback-text', 'consegui uma oportunidade de emprego que mudou minha vida.');
  });

  /**
   * Teste 6: Testa a navegação interna (links âncora)
   */
  it('Deve rolar para a seção "Sobre" ao clicar no link da navbar', () => {
    // Clica no link "Sobre" da navbar
    cy.contains('a.nav-link', 'Sobre').click();

    // Verifica se a URL foi atualizada com o hash
    cy.url().should('include', '#sobre');

    // Verifica se a seção "Sobre" está visível na tela
    // O Cypress aguarda o elemento ficar visível
    cy.get('#sobre').should('be.visible');
  });
  
  /**
   * Teste 7: Verifica o widget de acessibilidade VLibras
   */
  it('Deve carregar o widget de acessibilidade VLibras', () => {
    // Verifica se o contêiner principal do widget está na página
    cy.get('div[vw].enabled').should('exist').and('be.visible');
    
    // Verifica se o botão de acesso do widget está visível
    cy.get('div[vw-access-button].active').should('be.visible');
  });

});
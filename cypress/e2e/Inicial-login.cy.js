describe('Testes da Página Inicial - Reintegra', () => {

  beforeEach(() => {
    cy.visit('/Inicial-login.php');
  });

  it('1. Deve carregar a página e exibir o título e h1 corretos', () => {
    cy.title().should('eq', 'Reintegra - Reintegrando sua vida por completo');
    cy.get('h1.hero-title').should('be.visible')
      .and('contain', 'Reintegrando sua vida por completo');
  });

  context('2. Navegação (Desktop)', () => {
    beforeEach(() => {
      cy.viewport(1920, 1080);
    });

    it('Deve exibir os links de navegação e o ícone de perfil de desktop', () => {
      cy.get('.navbar-nav').contains('Serviços').should('be.visible');
      cy.get('.navbar-nav').contains('Feedback').should('be.visible');
      cy.get('.navbar-nav').contains('Contato').should('be.visible');
      cy.get('.navbar-nav').contains('Sobre').should('be.visible');
      cy.get('.navbar-nav').contains('Início').should('be.visible');
      cy.get('.nav-item.d-none.d-lg-block .btn-perfil').should('be.visible');
      cy.get('.d-lg-none.me-2 .btn-perfil').should('not.be.visible');
    });

    it('Deve rolar para a seção correta ao clicar em links âncora', () => {
      cy.get('.navbar-nav').contains('Sobre').click();
      cy.get('section#sobre h2').should('be.visible');
      cy.get('.navbar-nav').contains('Feedback').click();
      cy.get('section#cadastro h2').should('be.visible');
    });

    it('Deve adicionar sombra ao navbar ao rolar a página', () => {
      cy.get('.navbar').should('not.have.class', 'shadow');
      cy.scrollTo(0, 100);
      cy.get('.navbar').should('have.class', 'shadow');
      cy.scrollTo(0, 0);
      cy.get('.navbar').should('not.have.class', 'shadow');
    });
  });

context('3. Formulário de Feedback (Front-end)', () => {
  it('Deve mostrar um alerta de sucesso e limpar o campo ao enviar um feedback válido', () => {
    const meuFeedback = 'Testando o formulário de feedback com Cypress!';
    cy.intercept('POST', '**/Controller/FeedbackController.php', {
      statusCode: 200,
      body: { success: true, message: 'Obrigado pelo seu feedback!' }
    }).as('formSubmit');
    cy.get('input[name="feedback_mensagem"]').type(meuFeedback);
    cy.get('section#cadastro .btn-feedback-submit').click();
    cy.wait('@formSubmit');
    cy.get('.alert.alert-success', { timeout: 8000 })
      .should('be.visible')
      .and('contain', 'Obrigado pelo seu feedback!');
    cy.get('input[name="feedback_mensagem"]').should('have.value', '');
  });
});
  context('4. Navegação (Mobile)', () => {
    beforeEach(() => {
      cy.viewport('iphone-6');
    });

    it('Deve exibir o ícone de perfil móvel e o menu hamburguer', () => {
      cy.get('.d-lg-none.me-2 .btn-perfil').should('be.visible');
      cy.get('.nav-item.d-none.d-lg-block .btn-perfil').should('not.be.visible');
      cy.get('.navbar-toggler').should('be.visible');
    });

    it('Deve abrir e fechar o menu mobile ao clicar no toggler e em um item', () => {
      cy.get('#navbarNav').should('not.be.visible');
      cy.get('.navbar-toggler').click();
      cy.get('#navbarNav').should('be.visible');
      cy.get('#navbarNav').contains('Serviços').should('be.visible');
      cy.get('#navbarNav').contains('Sobre').click();
      cy.get('#navbarNav').should('not.have.class', 'show');
    });
  }); 

});
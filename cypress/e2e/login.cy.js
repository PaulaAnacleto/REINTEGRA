describe('Login - REINTEGRA', () => {
  const url = 'http://localhost/reintegra/view/Login.php';

  beforeEach(() => {
    cy.visit(url);
  });

  it('carrega página e elementos', () => {
    cy.title().should('contain', 'Login - REINTEGRA');
    cy.get('h2.form-title').should('contain.text', 'Entrar').and('be.visible');
    cy.get('.signup-link').should('have.attr', 'href').and('contain', 'Cadastro.php');
    cy.get('.submit-btn').should('exist').and('contain.text', 'Entrar');
    cy.get('#email').should('exist');
    cy.get('#senha').should('exist');
  });

  it('campos obrigatórios', () => {
    // garante inputs presentes
    cy.get('#email').should('exist');
    cy.get('#senha').should('exist');

    // dispara focus->blur em cada campo para acionar validações (o script usa blur)
    cy.get('#email').focus().blur();
    cy.get('#senha').focus().blur();

    // também submete o form para garantir fallback
    cy.get('#loginForm').submit();

    // checa mensagens de erro
    cy.get('#email').parent().parent().find('.error-message').should('be.visible').and('contain.text', 'Email é obrigatório');
    cy.get('#senha').parent().parent().find('.error-message').should('be.visible').and('contain.text', 'Senha é obrigatória');
  });

  it('email inválido', () => {
    cy.get('#email').type('email-invalido').blur();
    cy.get('#email').parent().parent().find('.error-message', { timeout: 4000 })
      .should('be.visible')
      .and('contain.text', 'Digite um email válido');

    // wrapper deve receber classe error
    cy.get('#email').parent().should('have.class', 'error');
  });

  it('senha curta', () => {
    cy.get('#senha').type('123').blur();
    cy.get('#senha').parent().parent().find('.error-message', { timeout: 4000 })
      .should('be.visible')
      .and('contain.text', 'Senha deve ter pelo menos 6 caracteres');

    cy.get('#senha').parent().should('have.class', 'error');
  });

  it('campos válidos', () => {
    cy.get('#email').type('usuario@example.com').blur();
    cy.get('#email').parent().should('have.class', 'success');

    cy.get('#senha').type('senhaSegura').blur();
    cy.get('#senha').parent().should('have.class', 'success');
  });

  it('botão Saiba mais com href correto', () => {
    // botão está dentro de um <a href="../View/index.php"> no HTML
    cy.get('.learn-more-btn').should('exist');
    cy.get('.learn-more-btn').closest('a').should('have.attr', 'href').and('contain', 'index.php');
  });
});

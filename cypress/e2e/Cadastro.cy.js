describe('Cadastro - REINTEGRA', () => {
  beforeEach(() => {
    cy.visit('http://localhost/reintegra/view/Cadastro.php');
  });

  it('exibe erros ao submeter com campos obrigatórios vazios', () => {
    cy.get('.submit-btn').click();
    cy.get('.input-group').eq(0).find('input').focus().blur();
    cy.get('.error-message').eq(0).should('contain.text', 'Nome completo é obrigatório');
    cy.get('.input-group').eq(1).find('input').focus().blur();
    cy.get('.error-message').eq(1).should('contain.text', 'Email é obrigatório');
    cy.get('.input-group').eq(2).find('input').focus().blur();
    cy.get('.error-message').eq(2).should('contain.text', 'Senha é obrigatória');
    cy.get('.input-group').eq(3).find('input').focus().blur();
    cy.get('.error-message').eq(3).should('contain.text', 'Confirmação de senha é obrigatória');
  });

  it('exibe erro para nome incompleto', () => {
    cy.get('#nomeCompleto').type('Helber').blur();
    cy.get('#nomeCompleto').parent().parent().find('.error-message').should('contain.text', 'Digite seu nome completo (nome e sobrenome)');
  });

  it('exibe erro para email inválido', () => {
    cy.get('#email').type('email-invalido').blur();
    cy.get('#email').parent().parent().find('.error-message').should('contain.text', 'Digite um email válido');
  });

  it('exibe erro para senha que não atende os requisitos', () => {
    cy.get('#senha').type('Pass123').blur();
    cy.get('#senha').parent().parent().find('.error-message').should('contain.text', 'Senha deve ter pelo menos 8 caracteres, incluindo maiúscula, minúscula e número');
  });

  it('exibe erro quando confirmação de senha é diferente', () => {
    cy.get('#senha').type('Password1');
    cy.get('#confirmarSenha').type('Password2').blur();
    cy.get('#confirmarSenha').parent().parent().find('.error-message').should('contain.text', 'As senhas não coincidem');
  });

  it('atribui classe "success" a campos válidos', () => {
    cy.get('#nomeCompleto').type('Helber Luiz').blur();
    cy.get('#nomeCompleto').parent().should('have.class', 'success');

    cy.get('#email').type('helber@example.com').blur();
    cy.get('#email').parent().should('have.class', 'success');

    cy.get('#senha').type('Password1').blur();
    cy.get('#senha').parent().should('have.class', 'success');

    cy.get('#confirmarSenha').type('Password1').blur();
    cy.get('#confirmarSenha').parent().should('have.class', 'success');
  });

it('exibe alerta de sucesso ao cadastrar (simulado)', () => {
  cy.intercept('POST', '**/UserController.php', {
    statusCode: 200,
    body: { 
      success: true, 
      message: 'Cadastro realizado com sucesso! Bem-vindo ao REINTEGRA!' 
    },
  }).as('fakeRegister');

  cy.window().then((win) => {
    cy.stub(win, 'alert').as('alertStub');
    cy.stub(win.location, 'href').as('locationHref'); 
  });

  cy.get('#nomeCompleto').type('Helber Luiz');
  cy.get('#email').type('helber@example.com');
  cy.get('#senha').type('Password1');
  cy.get('#confirmarSenha').type('Password1');

  cy.get('.submit-btn').click();
  cy.wait('@fakeRegister');

  cy.get('@alertStub').should(
    'have.been.calledWith',
    'Cadastro realizado com sucesso! Bem-vindo ao REINTEGRA!'
  );
});

  it('botão "Saiba mais" exibe alerta com mensagem informativa', () => {
    cy.window().then((win) => {
      cy.stub(win, 'alert').as('learnAlert');
    });

    cy.get('.learn-more-btn').click();
    cy.get('@learnAlert').should('have.been.calledOnce');
    cy.get('@learnAlert').its('firstCall.args.0').should('contain', 'Descubra oportunidades incríveis de emprego com o REINTEGRA');
  });
});

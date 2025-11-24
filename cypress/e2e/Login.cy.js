/// <reference types="cypress" />

describe('Testes de Validação da Página de Login (Login.php)', () => {
  
  const loginPage = '/View/Login.php';

  beforeEach(() => {

    cy.visit(loginPage);

    cy.window().then((win) => {
      cy.stub(win, 'alert').as('alertStub');
    });
  });

  it('deve carregar a página e exibir todos os elementos do formulário', () => {
 
    cy.title().should('eq', 'Login - REINTEGRA');

    // Lado Esquerdo
    cy.contains('.brand-title', 'REINTEGRA').should('be.visible');
    cy.contains('.learn-more-btn', 'Saiba mais').should('be.visible');

    // Lado Direito (Formulário)
    cy.contains('.form-title', 'Entrar').should('be.visible');
    cy.get('#email').should('be.visible').and('have.attr', 'placeholder', 'Email');
    cy.get('#senha').should('be.visible').and('have.attr', 'placeholder', 'Senha');
    cy.get('.submit-btn').should('be.visible').and('contain', 'Entrar');
    
    cy.get('a.signup-link').should('be.visible').and('contain', 'Cadastre-se');
    
    cy.get('a.forgot-link').should('be.visible').and('contain', 'Esqueceu a senha?');
  });

  it('deve mostrar erros de validação ao submeter o formulário vazio', () => {

    cy.get('form#loginForm').submit();

    cy.get('#email').parent().parent().find('.error-message')
      .should('be.visible')
      .and('contain', 'Email é obrigatório');
      
    cy.get('#senha').parent().parent().find('.error-message')
      .should('be.visible')
      .and('contain', 'Senha é obrigatória');
  });

  it('deve mostrar erro de email inválido no "blur" (ao sair do campo)', () => {
 
    cy.get('#email').type('emailinvalido.com').blur();
    
    cy.get('#email').parent().parent().find('.error-message')
      .should('be.visible')
      .and('contain', 'Digite um email válido');
  });

  it('deve mostrar erro de senha curta no "blur" (ao sair do campo)', () => {
   
    cy.get('#senha').type('123456').blur();
    
    cy.get('#senha').parent().parent().find('.error-message')
      .should('be.visible')
      .and('contain', 'Senha deve ter pelo menos 8 caracteres');
  });

  it('deve remover a mensagem de erro após corrigir o campo', () => {
 
    cy.get('#email').type('errado').blur();
    cy.get('#email').parent().should('have.class', 'error'); // Confirma que o erro apareceu

    cy.get('#email').clear().type('correto@email.com').blur();
    
   
    cy.get('#email').parent().should('not.have.class', 'error');
    cy.get('#email').parent().should('have.class', 'success');
  
    cy.get('#email').parent().parent().find('.error-message')
      .should('not.be.visible');
  });

  it('deve impedir o envio da requisição se a validação falhar', () => {
   
    cy.intercept('POST', '**/Controller/UserController.php').as('loginRequest');

    cy.get('#email').type('emailvalido@teste.com');
    cy.get('#senha').type('curta'); // Senha inválida

    cy.get('form#loginForm').submit();

    
    cy.get('#senha').parent().parent().find('.error-message')
      .should('be.visible')
      .and('contain', 'Senha deve ter pelo menos 8 caracteres');
   
    cy.wait(1000).then(() => {
      cy.get('@loginRequest.all').should('have.length', 0);
    });
  });


  it('deve navegar para a página de Cadastro ao clicar no link', () => {
    cy.get('a.signup-link').should('contain', 'Cadastre-se').click();
    cy.url().should('include', '/View/Cadastro.php');
  });

  it('deve navegar para a página "Saiba mais" (index.php)', () => {

    cy.get('a').contains('button.learn-more-btn', 'Saiba mais').click({ force: true });
    cy.url().should('include', '/View/index.php');
  });



});
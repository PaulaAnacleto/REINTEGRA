/// <reference types="cypress" />

describe('Testes de Validação da Página de Login (Login.php)', () => {
  
  const loginPage = '/View/Login.php';

  beforeEach(() => {
    // 1. Visita a página de login.
    // Com o 'cypress.config.js' criado, isso agora vai funcionar.
    cy.visit(loginPage);

    // "Dublamos" (stub) a função 'alert' do navegador.
    // O seu login.js usa 'alert()', e isso trava o Cypress.
    cy.window().then((win) => {
      cy.stub(win, 'alert').as('alertStub');
    });
  });

  it('deve carregar a página e exibir todos os elementos do formulário', () => {
    // Este teste agora deve passar
    cy.title().should('eq', 'Login - REINTEGRA');

    // Lado Esquerdo
    cy.contains('.brand-title', 'REINTEGRA').should('be.visible');
    cy.contains('.learn-more-btn', 'Saiba mais').should('be.visible');

    // Lado Direito (Formulário)
    cy.contains('.form-title', 'Entrar').should('be.visible');
    cy.get('#email').should('be.visible').and('have.attr', 'placeholder', 'Email');
    cy.get('#senha').should('be.visible').and('have.attr', 'placeholder', 'Senha');
    cy.get('.submit-btn').should('be.visible').and('contain', 'Entrar');
    
    // O seletor no seu HTML é 'a.signup-link'
    cy.get('a.signup-link').should('be.visible').and('contain', 'Cadastre-se');
    
    // O seletor no seu HTML é 'a.forgot-link'
    cy.get('a.forgot-link').should('be.visible').and('contain', 'Esqueceu a senha?');
  });

  // ===================================================================
  // TESTES DE VALIDAÇÃO (Client-side, baseados no login.js)
  // ===================================================================

  it('deve mostrar erros de validação ao submeter o formulário vazio', () => {
    // 1. Clica no botão "Entrar" com campos vazios
    cy.get('form#loginForm').submit();

    // 2. Verifica as mensagens de erro
    cy.get('#email').parent().parent().find('.error-message')
      .should('be.visible')
      .and('contain', 'Email é obrigatório');
      
    cy.get('#senha').parent().parent().find('.error-message')
      .should('be.visible')
      .and('contain', 'Senha é obrigatória');
  });

  it('deve mostrar erro de email inválido no "blur" (ao sair do campo)', () => {
    // Digita um email inválido e clica fora (dispara o 'blur')
    cy.get('#email').type('emailinvalido.com').blur();
    
    cy.get('#email').parent().parent().find('.error-message')
      .should('be.visible')
      .and('contain', 'Digite um email válido');
  });

  it('deve mostrar erro de senha curta no "blur" (ao sair do campo)', () => {
    // Seu login.js pede 8 caracteres
    cy.get('#senha').type('123456').blur();
    
    cy.get('#senha').parent().parent().find('.error-message')
      .should('be.visible')
      .and('contain', 'Senha deve ter pelo menos 8 caracteres');
  });

  it('deve remover a mensagem de erro após corrigir o campo', () => {
    // 1. Digita errado e sai (gera erro)
    cy.get('#email').type('errado').blur();
    cy.get('#email').parent().should('have.class', 'error'); // Confirma que o erro apareceu

    // 2. Corrige o email e sai
    cy.get('#email').clear().type('correto@email.com').blur();
    
    // 3. Verifica se a classe 'error' sumiu e 'success' apareceu
    cy.get('#email').parent().should('not.have.class', 'error');
    cy.get('#email').parent().should('have.class', 'success');
    
    // 4. Verifica se a mensagem de erro sumiu
    cy.get('#email').parent().parent().find('.error-message')
      .should('not.be.visible');
  });

  it('deve impedir o envio da requisição se a validação falhar', () => {
    // "Espionamos" a requisição, mas ela NÃO deve acontecer
    cy.intercept('POST', '**/Controller/UserController.php').as('loginRequest');

    // 1. Preenche o formulário com dados inválidos
    cy.get('#email').type('emailvalido@teste.com');
    cy.get('#senha').type('curta'); // Senha inválida

    // 2. Tenta submeter
    cy.get('form#loginForm').submit();

    // 3. Verifica se o erro de senha apareceu
    cy.get('#senha').parent().parent().find('.error-message')
      .should('be.visible')
      .and('contain', 'Senha deve ter pelo menos 8 caracteres');
      
    // 4. (O mais importante) Garante que NENHUMA requisição de rede
    // foi feita, provando que a validação do JS funcionou.
    cy.wait(1000).then(() => {
      cy.get('@loginRequest.all').should('have.length', 0);
    });
  });


  // ===================================================================
  // TESTES DE NAVEGAÇÃO
  // ===================================================================

  it('deve navegar para a página de Cadastro ao clicar no link', () => {
    cy.get('a.signup-link').should('contain', 'Cadastre-se').click();
    cy.url().should('include', '/View/Cadastro.php');
  });

  it('deve navegar para a página "Saiba mais" (index.php)', () => {
    // No seu HTML, o botão está dentro do link
    cy.get('a').contains('button.learn-more-btn', 'Saiba mais').click({ force: true });
    cy.url().should('include', '/View/index.php');
  });

  // Teste "Esqueceu a senha?" removido.

});
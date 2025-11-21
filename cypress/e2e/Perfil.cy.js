/// <reference types="cypress" />

describe('Página de Perfil (Perfil.php) – Testes E2E', () => {

  const loginPage = '/View/Login.php';
  const homePage = '/View/Inicial-login.php';
  const profilePage = '/View/Perfil.php';
  const userEmail = 'sophiadacy2@gmail.com';
  const userPassword = 'Lima1122@';

  beforeEach(() => {
 
    cy.session([userEmail, userPassword], () => {
      cy.visit(loginPage);
      cy.get('#email').type(userEmail);
      cy.get('#senha').type(userPassword);
      cy.get('form#loginForm').submit();
      cy.url().should('include', homePage);
    });


    cy.intercept('GET', '**/Controller/UserController.php').as('getUser');
    cy.intercept('POST', '**/Controller/UserController.php').as('updateUser');

   
    cy.visit(profilePage);

   
    cy.wait('@getUser');

  
    cy.window().then((win) => {
      cy.stub(win, 'alert').as('alertStub');
      cy.stub(win, 'confirm').returns(true);
    });
  });

 
  it('Deve carregar e exibir os dados do usuário', () => {
    // Verifica se os campos foram preenchidos com dados reais do BD
    cy.get('#nomeCompleto').should('not.have.value', '');
    cy.get('#email').should('have.value', userEmail);
    cy.get('#cpf').invoke('val').should('match', /^\d{3}\.\d{3}\.\d{3}-\d{2}$/);
    cy.get('#dataNascimento').invoke('val').should('match', /^\d{4}-\d{2}-\d{2}$/);
    cy.get('#profissao').should('not.have.value', '');
    // Verifica modo readonly
    cy.get('#nomeCompleto').should('have.attr', 'readonly');
  });

 
  it('Deve entrar no modo de edição e cancelar', () => {
cy.get('#nomeCompleto')
  .invoke('val')
  .then((originalName) => {

    cy.get('#editBtn').click();
    cy.get('#nomeCompleto').clear().type('Teste Cancelar');
    cy.get('#cancelBtn').click();

    // Verifica se voltou ao valor original
    cy.get('#nomeCompleto').should('have.value', originalName);
  });
  });

 
  it('Deve validar CPF inválido antes de salvar', () => {
    cy.get('#editBtn').click();
    cy.get('#cpf').clear().type('123456'); // formato incorreto
    cy.get('#saveBtn').click();

    cy.get('@alertStub')
      .should('have.been.calledWithMatch', /CPF deve estar no formato/);
  });

 
  it('Deve salvar as alterações com sucesso', () => {
    const novaProfissao = `Tester ${Math.floor(Math.random() * 100)}`;

    cy.get('#editBtn').click();
    cy.get('#profissao').clear().type(novaProfissao);
    cy.get('#saveBtn').click();

    // Espera o POST terminar
    cy.wait('@updateUser');

    // Verifica se o alerta foi chamado com mensagem de sucesso

    cy.window().its('alert').should('be.calledWithMatch', /Perfil atualizado/i);

    // Verifica se o botão voltou para modo readonly
    cy.get('#editBtn').should('be.visible');
    cy.get('#saveBtn').should('not.be.visible');

    // Confirma se o valor foi atualizado na tela
    cy.get('#profissao').should('have.value', novaProfissao);
  });

 
  it('Botão voltar deve redirecionar corretamente', () => {
    cy.visit(profilePage);
    cy.get('.back-button').click();

    cy.url().then((url) => {
      if (window.history.length > 1) {
        cy.go('back');
      } else {
        cy.url().should('include', '../View/inicial-login.php');
      }
    });
  });
});

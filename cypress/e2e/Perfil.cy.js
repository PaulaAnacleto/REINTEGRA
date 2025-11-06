/// <reference types="cypress" />

describe('Página de Perfil (Perfil.php)', () => {
  
  // As credenciais de teste que você forneceu
  const userEmail = 'sophiadacy2@gmail.com';
  const userPassword = 'Lima1122@';

  // URLs que vamos usar
  const loginPage = '/View/Login.php';
  const homePage = '/View/Inicial-login.php';
  const profilePage = '/View/Perfil.php';

  beforeEach(() => {
    // --- PASSO 1: FAZER O LOGIN PROGRAMATICAMENTE ---
    cy.session([userEmail, userPassword], () => {
      cy.window().then((win) => {
        cy.stub(win, 'alert').as('loginAlertStub');
      });
      cy.visit(loginPage);
      cy.get('#email').type(userEmail);
      cy.get('#senha').type(userPassword);
      cy.get('form#loginForm').submit();
      cy.url().should('include', homePage);
    });

    // --- PASSO 2: PREPARAÇÃO PARA O TESTE NA PÁGINA DE PERFIL ---
    
    // "Dublamos" (stub) o alert() e confirm() da página de perfil
    cy.window().then((win) => {
      cy.stub(win, 'alert').as('profileAlertStub');
      cy.stub(win, 'confirm').returns(true).as('confirmStub'); // Auto-confirma 'OK'
    });

    // "Espionamos" as requisições 'fetch'
    cy.intercept('GET', '**/Controller/UserController.php').as('loadUser');
    cy.intercept('POST', '**/Controller/UserController.php').as('updateUser');

    // Visitamos a página de perfil
    cy.visit(profilePage);

    // ===================================================================
    // CORREÇÃO PRINCIPAL:
    // Esperamos a requisição GET inicial (que o perfil.js faz) terminar
    // AQUI, dentro do 'beforeEach', antes de cada teste começar.
    // ===================================================================
    cy.wait('@loadUser');
  });

  it('deve carregar a página de perfil e exibir os dados do usuário', () => {
    // 1. O cy.wait('@loadUser') JÁ RODOU no 'beforeEach'.
    //    Os dados já estão na tela.

    // 2. Verifica os cabeçalhos
    cy.get('#userName').invoke('text').should('eq', 'Sophia Dacy');
    cy.get('#profileUserName').invoke('text').should('eq', 'Sophia Dacy');
    cy.get('#profileUserEmail').invoke('text').should('eq', userEmail);

    // 3. Verifica se os campos do formulário foram preenchidos
    // (Ajustados para os dados reais do seu usuário 'Sophia Dacy')
    cy.get('#nomeCompleto').should('have.value', 'Sophia Dacy'); 
    cy.get('#email').should('have.value', userEmail);
    cy.get('#cpf').should('have.value', '111.111.111-11');
    cy.get('#dataNascimento').should('have.value', '2007-12-01'); // Data do seu BD
    cy.get('#profissao').should('have.value', 'Estudante'); // Profissão do seu BD
    
    // 4. Verifica se os campos estão desabilitados (readonly)
    cy.get('#nomeCompleto').should('have.attr', 'readonly');
  });

  it('deve navegar da Página Inicial (logado) para a Página de Perfil', () => {
    // 1. Começa na página inicial (já estamos logados)
    cy.visit(homePage);
    
    // 2. Encontra o link do perfil na navbar (versão desktop)
    cy.get('.navbar-nav .d-none.d-lg-block a[href="../View/Perfil.php"]').click();

    // 3. Verifica se a URL mudou para a página de perfil
    cy.url().should('include', profilePage);
    cy.get('.page-title').should('contain.text', 'PÁGINA DE PERFIL');
  });

  // ===================================================================
  // TESTES DE INTERAÇÃO (Editar, Cancelar, Salvar)
  // ===================================================================

  it('deve entrar no modo de edição, alterar um campo e cancelar', () => {
    let originalName;
    cy.get('#nomeCompleto').invoke('val').then((name) => {
      originalName = name; // Salva o nome 'Sophia Dacy'
    });

    cy.get('#editBtn').click();
    cy.get('#saveBtn').should('be.visible');
    cy.get('#cancelBtn').should('be.visible');
    cy.get('#nomeCompleto').should('not.have.attr', 'readonly');
    
    cy.get('#nomeCompleto').clear().type('Nome Teste Cypress');
    cy.get('#cancelBtn').click(); // Clica em Cancelar

    // Verifica se o nome original foi restaurado
    cy.get('#nomeCompleto').should('have.value', originalName);
    cy.get('#editBtn').should('be.visible');
  });

  it('deve falhar ao tentar salvar um CPF inválido (validação do JS)', () => {
    cy.get('#editBtn').click();
    cy.get('#cpf').clear().type('123456'); // CPF inválido
    cy.get('#saveBtn').click();

    // Verifica se o alerta de erro (do seu perfil.js) foi chamado
    cy.get('@profileAlertStub')
      .should('have.been.calledWithMatch', /CPF deve estar no formato/);
  });

  it('deve salvar as alterações com sucesso (Teste E2E Real)', () => {
    // ATENÇÃO: Este teste FAZ UMA ALTERAÇÃO REAL no seu banco de dados
    
    const novaProfissao = `Testador(a) Cypress ${Math.floor(Math.random() * 100)}`;
    
    cy.get('#editBtn').click();
    cy.get('#profissao').clear().type(novaProfissao);
    cy.get('#saveBtn').click();
    
    // Verifica o estado de "loading"
    cy.get('#saveBtn').should('be.disabled').and('contain', 'Salvando...');
    
    // Espera a requisição POST para o UserController terminar
    cy.wait('@updateUser');

    // Verifica se o alerta de sucesso foi mostrado
    cy.get('@profileAlertStub')
      .should('have.been.calledWith', 'Perfil atualizado com sucesso!'); // (A mensagem exata do seu controller)
      
    // Verifica se o formulário voltou ao modo "readonly"
    cy.get('#editBtn').should('be.visible');
    cy.get('#saveBtn').should('not.be.visible');
    
    // (O MAIS IMPORTANTE) Verifica se o novo valor está salvo na página
    // Esta verificação agora vai funcionar, pois a página não recarrega mais
    cy.get('#profissao').should('have.value', novaProfissao);
  });

});
describe('Página de Informativos - Testes de Navegação e Funcionalidades', () => {
  
  beforeEach(() => {
    cy.visit('http://localhost/REINTEGRA/View/Informativos.php'); 
  });

  describe('Navegação e visualização da página de informativos', () => {
    
    it('Ao entrar na página, visualizo os links de Navegação', () => {
      // visualizar a barra de navegação com a logo
      cy.get('.navbar').should('be.visible');
      cy.get('.logo-text').should('contain.text', 'REINTEGRA');
      
      // E os links para outras páginas
      cy.get('.nav-link').should('have.length.greaterThan', 0);
    });
  });

  describe('Navegação - Botões do Menu', () => {
    
    it('Acessar página de Serviços', () => {

      // botão "Serviços"
      cy.contains('.nav-link', 'Serviços').click();
      
      // redirecionando à página de Serviços
      cy.url().should('include', 'http://localhost/REINTEGRA/View/Servicos.php');
    });

    it('Acessar a sessão "Feedback" da página inicial', () => {

      // botão "Feedback"
      cy.contains('.nav-link', 'Feedback').click();
      
      // redirecionando à sessão "Feedback" na página inicial
      cy.url().should('include', 'http://localhost/REINTEGRA/View/Inicial-login.php');
    });

    it('Acessar página de Contato', () => {

      // botão "Contato"
      cy.contains('.nav-link', 'Contato').click();
      
      // Então eu devo ser redirecionado à página de Contato
      cy.url().should('include', 'http://localhost/REINTEGRA/View/Contato.php');
    });

    it('Acessar a sessão "Sobre" da página inicial', () => {
      // botão "Sobre"
      cy.contains('.nav-link', 'Sobre').click();
      
      // redirecionando à sessão "Sobre" na página inicial
      cy.url().should('include', 'http://localhost/REINTEGRA/View/Inicial-login.php');
    });

    it('Acessar página inicial', () => {
      // botão "Início"
      cy.contains('.nav-link', 'Início').click();
      
      // redirecionando à página inicial
      cy.url().should('include', 'http://localhost/REINTEGRA/View/Inicial-login.php');
    });
  });

  describe('Navegação - Botões de Perfil e Voltar', () => {
    
    it('Acessar página de perfil', () => {
      // botão com ícone de Perfil
      cy.get('#perfil').click()
      
      // Então eu devo ser redirecionado à página de Perfil
      cy.url().should('include', 'http://localhost/REINTEGRA/View/Perfil.php');
    });

    it('Voltar para a página anterior', () => {

      //  botão com ícone de seta
      cy.get('.back-button').click();
      
      // redirecionando à página anterior que eu estava navegando
      // Verifica se o histórico de navegação foi usado
      cy.url().should('not.include', '/informativos');
    });
  });

  describe('Cards de Informativos - Links Externos', () => {
    
    it('Acessar página "Exame – seção Mercado de Trabalho"', () => {

      // botão "Saiba mais" do card "Exame – seção Mercado de Trabalho"
      cy.contains('.card', 'Exame')
        .find('a[target="_blank"]')
        .should('have.attr', 'href')
        .and('include', 'exame.com');
      
      // Então eu devo ser redirecionado ao site "Exame – seção Mercado de Trabalho"
      // verificando os atributos href
    });

    it('Acessar página "Forbes Brasil"', () => {

      // botão "Saiba mais" do card "Forbes Brasil"
      cy.contains('.card', 'Forbes Brasil')
        .find('a[target="_blank"]')
        .should('have.attr', 'href')
        .and('include', 'forbes.com.br');
      
      // redirecionando ao site "Forbes Brasil"
    });

    it('Acessar página "InfoMoney - seção Mercado de Trabalho"', () => {

      // botão "Saiba mais" do card "InfoMoney - seção Mercado de Trabalho"
      cy.contains('.card', 'InfoMoney')
        .find('a[target="_blank"]')
        .should('have.attr', 'href')
        .and('include', 'infomoney.com.br');
      
      //redirecionando ao site "InfoMoney - seção Mercado de Trabalho"
    });

    it('Acessar página "Vagas do Dia - SineBahia"', () => {

      // botão "Saiba mais" do card "Vagas do Dia - SineBahia"
      cy.contains('.card', 'Vagas do Dia')
        .find('a[target="_blank"]')
        .should('have.attr', 'href')
        .and('include', 'ba.gov.br');
      
      // Então eu devo ser redirecionado ao site "Vagas do Dia - SineBahia"
    });

    it('Acessar página "Agência Brasil / EBC"', () => {
      // botão "Saiba mais" do card "Agência Brasil / EBC"
      cy.contains('.card', 'Agência Brasil')
        .find('a[target="_blank"]')
        .should('have.attr', 'href')
        .and('include', 'agenciabrasil.ebc.com.br');
      
      // redirecionando ao site "Agência Brasil / EBC"
    });
  });

  describe('Footer - Links de Políticas', () => {
    
    it('Acessar página Políticas de Privacidade', () => {

      //botão "Políticas de Privacidade" do footer
      cy.get('.footer').contains('Política de Privacidade').click();
      
      // redirecionando à página Políticas de Privacidade
      cy.url().should('include', 'http://localhost/REINTEGRA/View/Politica-privacidade.php');
    });

    it('Acessar página Termos de Serviço', () => {
      // botão "Termos de Serviço" do footer
      cy.get('.footer').contains('Termos de Serviço').click();
      
      //redirecionando à página Termos de Serviço
      cy.url().should('include', 'http://localhost/REINTEGRA/View/termos-servico.php');
    });
  });

  describe('Widget VLibras', () => {
    
    it('Verificar se o widget VLibras é carregado corretamente', () => {
         // Verifica se o contêiner principal do widget está na página
    cy.get('div[vw].enabled').should('exist').and('be.visible');
    
    // Verifica se o botão de acesso do widget está visível
    cy.get('div[vw-access-button].active').should('be.visible');
    });
  });
});
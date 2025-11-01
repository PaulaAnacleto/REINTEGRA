describe('Testes Front-End da Página de Vagas', () => {
  beforeEach(() => {
    cy.visit('View/Vagas.php'); 
  });

  it('Deve carregar o título e o cabeçalho principal', () => {
    // 1. Verifica o título da aba do navegador
    cy.title().should('eq', 'Vagas - Reintegra');

    // 2. Verifica o logo na navbar
    cy.get('.logo-text').should('contain', 'REINTEGRA');

    // 3. Verifica o título principal da seção hero
    cy.get('.hero-title').should('contain', 'VAGAS');

    // 4. Verifica a descrição
    cy.contains('p', 'Encontre os melhores sites para descobrir oportunidades').should('be.visible');
  });

  it('Deve exibir todos os 6 cards de vagas', () => {
    // 1. Verifica se todos os 6 cards estão presentes
    cy.get('.card-item').should('have.length', 6);

    // 2. Faz uma verificação rápida dos títulos dos cards
    cy.contains('h2', 'Indeed').should('be.visible');
    cy.contains('h2', 'Infojobs').should('be.visible');
    cy.contains('h2', 'Catho').should('be.visible');
    cy.contains('h2', 'Empregos.com.br').should('be.visible');
    cy.contains('h2', 'Trabalha Brasil').should('be.visible');
    cy.contains('h2', 'Glassdoor').should('be.visible');
  });

  it('Deve verificar o conteúdo e o link do card "Indeed"', () => {
    // 1. Encontra o card "Indeed"
    // Usamos .first() por ser o primeiro card após o "CARD 2" (que é o primeiro na lista)
    // Uma forma mais segura seria usar cy.contains('h2', 'Indeed').closest('.card-item')
    cy.get('.card-item').first().within(() => {
      // 2. Verifica os itens da lista
      cy.get('li').should('have.length', 4);
      cy.contains('li', 'Possui milhares de vagas').should('be.visible');

      // 3. Verifica o botão
      cy.get('.btn-primary').should('contain', 'Vagas');

      // 4. Verifica o link (a tag <a>) que envolve o botão
      cy.get('a')
        .should('have.attr', 'target', '_blank')
        .and('have.attr', 'href', 'https://querobolsa.com.br/teste-vocacional-gratis?utm_source=');
    });
  });

  it('Deve verificar a navegação e o rodapé', () => {
    // 1. Verifica um link da navbar
    cy.contains('nav .nav-link', 'Serviços').should('have.attr', 'href', '../view/Servicos');

    // 2. Verifica o botão de perfil (versão desktop)
    cy.get('.nav-item.d-none.d-lg-block a').should('have.attr', 'href', '../View/Perfil.php');

    // 3. Verifica o texto do rodapé
    cy.get('.footer-text').should('contain', '© 2025 Reintegra. Todos os direitos reservados.');

    // 4. Verifica um link do rodapé
    cy.contains('.footer-link', 'Política de Privacidade').should('have.attr', 'href', '#');
  });

});
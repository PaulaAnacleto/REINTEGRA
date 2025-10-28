describe('Política de Privacidade - REINTEGRA', () => {
  const url = 'http://localhost/reintegra/view/Politica-privacidade.php';

  beforeEach(() => {
    cy.visit(url);
  });

  it('carrega a página e tem o título correto', () => {
    cy.title().should('contain', 'Política de Privacidade');
    cy.get('h1.title').should('contain.text', 'Política de').and('be.visible');
  });

  it('exibe a data de última atualização esperada', () => {
    cy.get('.update-date')
      .should('be.visible')
      .and('contain.text', 'Última atualização: 14 de outubro de 2025');
  });

  it('botão de voltar existe, tem aria-label e imagem com alt, e chama history.back() ao clicar', () => {
    cy.get('.back-button').should('exist').and('have.attr', 'aria-label', 'Voltar');
    cy.get('.back-button .back-icon').should('have.attr', 'alt', 'Voltar');

    cy.window().then((win) => {
      // stub history.back para verificar que foi chamado
      cy.stub(win.history, 'back').as('historyBack');
    });

    cy.get('.back-button').click();
    cy.get('@historyBack').should('have.been.called');
  });

  it('possui link no footer para termos de serviço', () => {
    cy.get('footer .footer-link')
      .should('exist')
      .and('have.attr', 'href')
      .and('contain', 'termos-servico.php');
  });

  it('insere estilos de impressão (style tag com @media print)', () => {
    cy.document().then((doc) => {
      const styleTags = Array.from(doc.head.querySelectorAll('style'));
      const found = styleTags.some(s => /@media\s+print/.test(s.textContent || ''));
      expect(found).to.equal(true);
    });

    // verifica presença de regra que oculta .back-button no print
    cy.document().then((doc) => {
      const styleTags = Array.from(doc.head.querySelectorAll('style'));
      const containsBackButton = styleTags.some(s => /\.back-button[\s\S]*display:\s*none/.test(s.textContent || ''));
      expect(containsBackButton).to.equal(true);
    });
    });
    
    it('footer "Termos de Serviço" redireciona para a página de termos', () => {
  cy.get('footer .footer-link').should('exist').and('have.attr', 'href').then((href) => {
    cy.get('footer .footer-link').click();
    cy.url({ timeout: 10000 }).should('include', 'termos-servico.php');
  });
});


  });

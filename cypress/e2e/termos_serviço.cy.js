describe('Termos de Serviço', () => {
  const url = 'http://localhost/reintegra/View/termos-servico.php';
  beforeEach(() => {
    cy.visit(url);
  });

  it('abre a página', () => {
    cy.title().should('contain', 'Termos de Serviço');
    cy.get('h1.title').should('be.visible').and('contain.text', 'Termos de');
  });

  it('mostra data de atualização', () => {
    cy.get('.update-date')
      .should('be.visible')
      .and('contain.text', 'Última atualização: 14 de outubro de 2025');
  });

  it('botão voltar funciona', () => {
    cy.get('.back-button').should('exist').and('have.attr', 'aria-label', 'Voltar');
    cy.get('.back-button .back-icon').should('have.attr', 'alt', 'Voltar');

    cy.window().then((win) => {
      cy.stub(win.history, 'back').as('historyBack');
    });

    cy.get('.back-button').click();
    cy.get('@historyBack').should('have.been.called');
  });

  
  it('rodapé tem link de privacidade', () => {
    cy.get('footer .footer-link')
      .should('exist')
      .and('contain.text', 'Política de Privacidade')
      .and('have.attr', 'href');
  });

  it('contém seções importantes', () => {
    cy.contains('1. Aceitação dos Termos').should('exist');
    cy.contains('12. Lei Aplicável').should('exist');
  });it('contatos são links corretos (E-mail, Telefone, WhatsApp)', () => {
    // Verifica email
    cy.contains('E-mail').parent().within(() => {
      cy.get('a')
        .should('have.attr', 'href')
        .and('include', 'mailto:reintegracontato@gmail.com');
      cy.contains('reintegracontato@gmail.com').should('exist');
    });

    // Verifica telefone (normaliza dígitos antes de comparar)
    const telefoneEsperado = '08007866890'; // "0800 786 6890" -> somente dígitos
    cy.contains('Telefone').parent().within(() => {
      cy.get('a')
        .should('have.attr', 'href')
        .then((href) => {
          const digits = href.replace(/\D/g, '');
          expect(digits).to.contain(telefoneEsperado);
        });
      cy.contains('0800').should('exist');
    });

    // Verifica WhatsApp (checa wa.me e número com DDI 55)
    const whatsappEsperado = '5571993105092'; // "71 99310-5092" -> com DDI 55 -> 5571993105092
    cy.contains('WhatsApp').parent().within(() => {
      cy.get('a')
        .should('have.attr', 'href')
        .and('match', /wa\.me|api\.whatsapp\.com/)
        .then((href) => {
          const digits = href.replace(/\D/g, '');
          expect(digits).to.contain(whatsappEsperado);
        });
      cy.contains('71').should('exist');
    });
  });

});

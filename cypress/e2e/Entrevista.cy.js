describe('Página Entrevista - Reintegra', () => {
  const url = 'http://localhost/reintegra/View/Entrevista.php'

  beforeEach(() => {
    cy.visit(url)
  })

  it('carrega a página', () => {
    cy.get('h1.hero-title').should('be.visible').and('contain.text', 'ENTREVISTA DE EMPREGO')
    cy.get('p.hero-description').should('be.visible').and('contain.text', 'Seja você')
  })

  it('navbar contém links', () => {
    cy.get('nav.navbar').within(() => {
      cy.get('.nav-link').should('have.length.gte', 4)
      cy.contains('.nav-link', 'Serviços').should('exist')
      cy.contains('.nav-link', 'Contato').should('exist')
      cy.contains('.nav-link', 'Início').should('exist')
    })
  })

  it('mostra 4 cards', () => {
    cy.get('.card-item').should('have.length', 4)
    cy.get('.card-item').each(($card) => {
      cy.wrap($card).find('.card-title').should('be.visible').and('not.be.empty')
      cy.wrap($card).find('.card-image img').should('be.visible').and(($img) => {
        expect($img.attr('alt')).to.exist
      })
    })
  })

  it('botão voltar presente', () => {
    cy.get('.back-button').should('exist').and('have.attr', 'aria-label', 'Voltar')
    //apenas garantia de presença
  })
})
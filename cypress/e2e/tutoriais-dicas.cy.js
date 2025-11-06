describe('Página Tutoriais e Dicas - Reintegra', () => {
  const pagePath = 'http://localhost/REINTEGRA-1/view/tutoriais-dicas.php' // ajuste se o caminho local for diferente

  beforeEach(() => {
    cy.visit(pagePath)
  })

  it('Deve carregar a página com o título do documento correto', () => {
    cy.title().should('eq', 'Tutoriais e Dicas - Reintegra')
  })

  it('Deve exibir o título hero e a descrição', () => {
    cy.get('.hero-title').should('be.visible').and('contain', 'TUTORIAIS E DICAS')
    cy.get('.hero-description').should('be.visible').and('contain', 'Descubra conteúdos práticos')
  })

  it('Deve ter 3 cartões com os títulos esperados', () => {
    cy.get('.card-item').should('have.length.at.least', 3)
    cy.get('.card-item').eq(0).within(() => {
      cy.get('.card-title').should('contain', 'Monte seu Currículo')
    })
    cy.get('.card-item').eq(1).within(() => {
      cy.get('.card-title').should('contain', 'Domine a Entrevista')
    })
    cy.get('.card-item').eq(2).within(() => {
      cy.get('.card-title').should('contain', 'Aproveitando o Poder do Networking')
    })
  })

  it('Deve ter 3 botões "Começar" visíveis e com classe .btn-primary', () => {
    cy.get('button.btn-primary').should('have.length.at.least', 3)
    cy.get('button.btn-primary').each(($btn) => {
      cy.wrap($btn).should('be.visible').and('contain', 'Começar')
    })
  })

  it('Cada cartão deve exibir imagem e lista de tópicos', () => {
    cy.get('.card-item').each(($card) => {
      cy.wrap($card).within(() => {
        cy.get('img').should('exist').and('be.visible')
        cy.get('ul').should('exist')
        cy.get('ul > li').should('have.length.at.least', 1)
      })
    })
  })

  it('Navbar deve conter links principais visíveis', () => {
    cy.get('.navbar').within(() => {
      cy.contains('Serviços').should('exist')
      cy.contains('Contato').should('exist')
      cy.contains('Início').should('exist')
    })
  })
})

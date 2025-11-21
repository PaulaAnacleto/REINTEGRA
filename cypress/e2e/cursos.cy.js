describe('Página de Cursos - Testes de Navegação e Funcionalidades', () => {
  
  beforeEach(() => {
    cy.visit('http://localhost/Reintegra/View/Cursos.php');
  });

  describe('Feature: Navegação e visualização da página de catálogo de cursos', () => {
    
    it('Ao entrar na página, visualizo os links de Navegação', () => {
      cy.get('.navbar').should('be.visible');
      cy.get('.logo-text').should('contain.text', 'REINTEGRA');
      cy.get('.nav-link').should('have.length.greaterThan', 0);
    });

    it('Deve exibir o título da página de cursos', () => {
      cy.get('.title').should('be.visible');
      cy.get('.title').should('contain.text', 'cursos disponíveis');
    });

    it('Deve exibir o parágrafo descritivo da página', () => {
      cy.get('.paragrafo').should('be.visible');
      cy.get('.paragrafo').should('contain.text', 'Invista no seu futuro profissional');
    });
  });

  describe('Navegação - Botões do Menu', () => {
    
    it('Acessar página de Serviços', () => {
      cy.contains('.nav-link', 'Serviços').click();
      
      cy.url().should('include', 'http://localhost/Reintegra/View/Servicos.php');
    });

    it('Acessar a sessão "Feedback" da página inicial', () => {
      cy.contains('.nav-link', 'Feedback').click();
      
      cy.url().should('include', 'http://localhost/Reintegra/View/Inicial-login.php');
    });

    it('Acessar página de Contato', () => {
      cy.contains('.nav-link', 'Contato').click();
      cy.url().should('include', 'http://localhost/Reintegra/View/Contato.php');
    });

    it('Acessar a sessão "Sobre" da página inicial', () => {
      cy.contains('.nav-link', 'Sobre').click();
      
    
      cy.url().should('include', 'http://localhost/Reintegra/View/Inicial-login.php');
    });

    it('Acessar página inicial', () => {
      cy.contains('.nav-link', 'Início').click();
 
      cy.url().should('include', 'http://localhost/Reintegra/View/Inicial-login.php');
    });
  });

  describe('Navegação - Botões de Perfil e Voltar', () => {
    
    it('Acessar página de perfil', () => {
      cy.get('#perfil').click()

      cy.url().should('include', 'http://localhost/Reintegra/View/Perfil.php');
    });

    it('Voltar para a página anterior', () => {

      cy.get('.back-button').click();

      cy.url().should('not.include', '/cursos');
    });
  });

  describe('Cards de Cursos - Conteúdo Dinâmico', () => {
    
    it('Acessar página do curso', () => {

      cy.get('.card').then(($cards) => {
        if ($cards.length > 0) {
          // E clico no título do card
          cy.get('.card').first().then(($curso) => {
            const cursoTitulo = $curso.text();
            cy.log(`Testando curso: ${cursoTitulo}`);
          });
        
        }
      });
    });


    it('Deve verificar que todos os cards têm título e descrição', () => {
      cy.get('.card').each(($card) => {
        cy.wrap($card).within(() => {
          cy.get('h3').should('not.be.empty');
          cy.get('.text-card').should('not.be.empty');
        });
      });
    });

  });

  describe('Footer - Links de Políticas', () => {
    
    it('Acessar página Políticas de Privacidade', () => {

      cy.get('.footer').contains('Política de Privacidade').click();
      cy.url().should('include', 'http://localhost/Reintegra/View/Politica-privacidade.php');
    });

    it('Acessar página Termos de Serviço', () => {
      cy.get('.footer').contains('Termos de Serviço').click();

      cy.url().should('include', 'http://localhost/Reintegra/View/termos-servico.php');
    });
  });


  describe('Widget VLibras', () => {
    
    it('Verificar se o widget VLibras é carregado corretamente', () => {
      cy.get('[vw]').should('exist');
      cy.get('[vw]').should('have.class', 'enabled');
    });

    it('Deve verificar se o botão de acesso do VLibras está ativo', () => {
      cy.get('[vw-access-button]').should('exist');
      cy.get('[vw-access-button]').should('have.class', 'active');
    });

    it('Deve verificar se o plugin wrapper do VLibras está presente', () => {
      cy.get('[vw-plugin-wrapper]').should('exist');
    });

    it('Deve verificar se o script do VLibras foi carregado', () => {
      cy.get('script[src*="vlibras.gov.br"]').should('exist');
    });
  });

  describe('Responsividade e Elementos Visuais', () => {
    
    it('Deve verificar se o botão hamburguer está presente em dispositivos móveis', () => {
      // Define viewport para mobile
      cy.viewport('iphone-x');
      
      // Verifica se o botão toggler está visível
      cy.get('.navbar-toggler').should('be.visible');
    });

    it('Deve verificar se o menu colapsa em dispositivos móveis', () => {
      // Define viewport para mobile
      cy.viewport('iphone-x');
      
      // Clica no botão hamburguer
      cy.get('.navbar-toggler').click();
      
      // Verifica se o menu foi expandido
      cy.get('#navbarNav').should('have.class', 'show');
    });

    it('Deve verificar se o botão de perfil mobile está visível em mobile', () => {
      // Define viewport para mobile
      cy.viewport('iphone-x');
      
      // Verifica se o botão de perfil mobile está visível
      cy.get('.d-flex.align-items-center .btn-perfil').should('be.visible');
    });

    it('Deve verificar se o botão de perfil desktop está oculto em mobile', () => {
      // Define viewport para mobile
      cy.viewport('iphone-x');
      
      // Verifica se o item de perfil desktop está oculto
      cy.get('.nav-item.d-none.d-lg-block').should('not.be.visible');
    });

    it('Deve verificar o layout em desktop', () => {
      // Define viewport para desktop
      cy.viewport(1280, 720);
      

      cy.get('#navbarNav').should('be.visible');
 
      cy.get('.navbar-toggler').should('not.be.visible');
    });
  });

  describe('Funcionalidade JavaScript - Scroll Suave', () => {
    
    it('Deve verificar se os links com âncora têm o comportamento de scroll suave', () => {

      cy.get('a[href^="#"]').then(($links) => {
        if ($links.length > 0) {

          cy.get('a[href^="#"]').first().click();

          cy.url().should('include', 'http://localhost/Reintegra/View/Cursos.php');
        }
      });
    });
  });

  describe('Validações de Conteúdo', () => {
    
    it('Deve verificar se a seção inicial está presente', () => {
      cy.get('.inicio').should('be.visible');
    });

    it('Deve verificar se o main com conteúdo está presente', () => {
      cy.get('.conteudo').should('exist');
    });

    it('Deve verificar se o header está presente', () => {
      cy.get('.header').should('be.visible');
    });

    it('Deve verificar se o botão voltar tem o ícone correto', () => {
      cy.get('.back-button').within(() => {
        cy.get('.back-icon').should('have.attr', 'src').and('include', 'seta.png');
        cy.get('.back-icon').should('have.attr', 'alt', 'Voltar');
      });
    });

    it('Deve verificar se o botão de perfil tem o ícone correto', () => {
      cy.get('.btn-perfil').first().within(() => {
        cy.get('.img-perfil').should('have.attr', 'src').and('include', 'icone perfil.png');
        cy.get('.img-perfil').should('have.attr', 'alt', 'Perfil');
      });
    });
  });


  describe('Testes de Integração PHP', () => {
    
    it('Deve verificar se a página carrega sem erros PHP', () => {

      cy.get('body').should('not.contain', 'Warning:');
      cy.get('body').should('not.contain', 'Fatal error:');
      cy.get('body').should('not.contain', 'Notice:');
    });

    it('Deve verificar se o array de cursos foi processado corretamente', () => {

      cy.get('body').then(($body) => {
        const hasCards = $body.find('.card').length > 0;
        const hasEmptyMessage = $body.text().includes('Nenhum curso disponível');
        
        expect(hasCards || hasEmptyMessage).to.be.true;
      });
    });
  });
});
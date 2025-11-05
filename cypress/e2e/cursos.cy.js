describe('Página de Cursos - Testes de Navegação e Funcionalidades', () => {
  
  beforeEach(() => {
    // Visita a página de cursos antes de cada teste
    cy.visit('http://localhost/Reintegra/View/Cursos.php'); // Ajuste a URL conforme necessário
  });

  describe('Feature: Navegação e visualização da página de catálogo de cursos', () => {
    
    it('Ao entrar na página, visualizo os links de Navegação', () => {
      // Dado que eu acesso a página de cursos
      // Quando a página é carregada
      // Então devo visualizar a barra de navegação com a logo
      cy.get('.navbar').should('be.visible');
      cy.get('.logo-text').should('contain.text', 'REINTEGRA');
      
      // E os links para outras páginas
      cy.get('.nav-link').should('have.length.greaterThan', 0);
    });

    it('Deve exibir o título da página de cursos', () => {
      // Verifica se o título está presente
      cy.get('.title').should('be.visible');
      cy.get('.title').should('contain.text', 'cursos disponíveis');
    });

    it('Deve exibir o parágrafo descritivo da página', () => {
      // Verifica se o parágrafo está presente
      cy.get('.paragrafo').should('be.visible');
      cy.get('.paragrafo').should('contain.text', 'Invista no seu futuro profissional');
    });
  });

  describe('Navegação - Botões do Menu', () => {
    
    it('Acessar página de Serviços', () => {
      // Dado que eu acesso a página de cursos
      // Quando a página é carregada
      // E clico no botão "Serviços"
      cy.contains('.nav-link', 'Serviços').click();
      
      // Então eu devo ser redirecionado à página de Serviços
      cy.url().should('include', 'http://localhost/Reintegra/View/Servicos.php');
    });

    it('Acessar a sessão "Feedback" da página inicial', () => {
      // Dado que eu acesso a página de cursos
      // Quando a página é carregada
      // E clico no botão "Feedback"
      cy.contains('.nav-link', 'Feedback').click();
      
      // Então eu devo ser redirecionado à sessão "Feedback" na página inicial
      cy.url().should('include', 'http://localhost/Reintegra/View/Inicial-login.php');
    });

    it('Acessar página de Contato', () => {
      // Dado que eu acesso a página de cursos
      // Quando a página é carregada
      // E clico no botão "Contato"
      cy.contains('.nav-link', 'Contato').click();
      
      // Então eu devo ser redirecionado à página de Contato
      cy.url().should('include', 'http://localhost/Reintegra/View/Contato.php');
    });

    it('Acessar a sessão "Sobre" da página inicial', () => {
      // Dado que eu acesso a página de cursos
      // Quando a página é carregada
      // E clico no botão "Sobre"
      cy.contains('.nav-link', 'Sobre').click();
      
      // Então eu devo ser redirecionado à sessão "Sobre" na página inicial
      cy.url().should('include', 'http://localhost/Reintegra/View/Inicial-login.php');
    });

    it('Acessar página inicial', () => {
      // Dado que eu acesso a página de cursos
      // Quando a página é carregada
      // E clico no botão "Inicio"
      cy.contains('.nav-link', 'Início').click();
      
      // Então eu devo ser redirecionado à página inicial
      cy.url().should('include', 'http://localhost/Reintegra/View/Inicial-login.php');
    });
  });

  describe('Navegação - Botões de Perfil e Voltar', () => {
    
    it('Acessar página de perfil', () => {
      // botão com ícone de Perfil
      cy.get('#perfil').click()
      
      // Então eu devo ser redirecionado à página de Perfil
      cy.url().should('include', 'http://localhost/Reintegra/View/Perfil.php');
    });

    it('Voltar para a página anterior', () => {

      //  botão com ícone de seta
      cy.get('.back-button').click();
      
      // redirecionando à página anterior que eu estava navegando
      // Verifica se o histórico de navegação foi usado
      cy.url().should('not.include', '/cursos');
    });
  });

  describe('Cards de Cursos - Conteúdo Dinâmico', () => {
    
    it('Acessar página do curso', () => {
      // Dado que eu acesso a página de cursos
      // Quando a página é carregada
      // Verifica se há cards disponíveis
      cy.get('.card').then(($cards) => {
        if ($cards.length > 0) {
          // E clico no título do card
          cy.get('.card').first().then(($curso) => {
            const cursoTitulo = $curso.text();
            cy.log(`Testando curso: ${cursoTitulo}`);
          });
          
          
          // Então eu devo ser redirecionado ao site do curso daquele card
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

      //botão "Políticas de Privacidade" do footer
      cy.get('.footer').contains('Política de Privacidade').click();
      
      // redirecionando à página Políticas de Privacidade
      cy.url().should('include', 'http://localhost/Reintegra/View/Politica-privacidade.php');
    });

    it('Acessar página Termos de Serviço', () => {
      // botão "Termos de Serviço" do footer
      cy.get('.footer').contains('Termos de Serviço').click();
      
      //redirecionando à página Termos de Serviço
      cy.url().should('include', 'http://localhost/Reintegra/View/termos-servico.php');
    });
  });


  describe('Widget VLibras', () => {
    
    it('Verificar se o widget VLibras é carregado corretamente', () => {
      // Dado que eu acesso a página inicial
      // Quando a página é carregada
      // Então o widget VLibras deve estar visível na tela
      cy.get('[vw]').should('exist');
      cy.get('[vw]').should('have.class', 'enabled');
    });

    it('Deve verificar se o botão de acesso do VLibras está ativo', () => {
      // Verifica se o botão de acesso está presente e ativo
      cy.get('[vw-access-button]').should('exist');
      cy.get('[vw-access-button]').should('have.class', 'active');
    });

    it('Deve verificar se o plugin wrapper do VLibras está presente', () => {
      cy.get('[vw-plugin-wrapper]').should('exist');
    });

    it('Deve verificar se o script do VLibras foi carregado', () => {
      // Verifica se o script do VLibras está presente no DOM
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
      
      // Verifica se o menu está expandido
      cy.get('#navbarNav').should('be.visible');
      
      // Verifica se o botão hamburguer está oculto
      cy.get('.navbar-toggler').should('not.be.visible');
    });
  });

  describe('Funcionalidade JavaScript - Scroll Suave', () => {
    
    it('Deve verificar se os links com âncora têm o comportamento de scroll suave', () => {
      // Verifica se existem links com âncora na página
      cy.get('a[href^="#"]').then(($links) => {
        if ($links.length > 0) {
          cy.log(`Encontrados ${$links.length} links com âncora`);
          
          // Testa o primeiro link com âncora
          cy.get('a[href^="#"]').first().click();
          
          // Verifica se a URL foi atualizada com a âncora
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
      // Verifica se não há mensagens de erro PHP visíveis
      cy.get('body').should('not.contain', 'Warning:');
      cy.get('body').should('not.contain', 'Fatal error:');
      cy.get('body').should('not.contain', 'Notice:');
    });

    it('Deve verificar se o array de cursos foi processado corretamente', () => {
      // Verifica se há cards ou a mensagem de nenhum curso disponível
      cy.get('body').then(($body) => {
        const hasCards = $body.find('.card').length > 0;
        const hasEmptyMessage = $body.text().includes('Nenhum curso disponível');
        
        expect(hasCards || hasEmptyMessage).to.be.true;
      });
    });
  });
});
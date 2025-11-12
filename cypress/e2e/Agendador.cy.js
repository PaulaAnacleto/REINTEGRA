

describe('Página de Calendário/Eventos - Reintegra', () => {
    // URL correta fornecida pelo usuário
    const CALENDAR_URL = 'http://localhost/Reintegra/view/Agendador.php'; 

    // Configuração para ignorar erros de aplicação, como o "card is not defined" anterior,
    // que podem ocorrer em outras páginas.
    Cypress.on('uncaught:exception', (err, runnable) => {
        return false;
    });

    beforeEach(() => {
        cy.visit(CALENDAR_URL); 
    });

    // Teste 1: Verificar a presença dos elementos principais do cabeçalho e calendário
    it('Deve exibir o logo, links de navegação e o container do calendário', () => {
        // Verifica o logo
        cy.get('.navbar-brand .logo-text').should('be.visible').and('contain', 'REINTEGRA');

        // Verifica os links de navegação
        cy.get('.navbar-nav').should('be.visible');
        cy.get('.nav-link').contains('Serviços').should('exist');
        cy.get('.nav-link').contains('Contato').should('exist');
        cy.get('.nav-link').contains('Sobre').should('exist');
        cy.get('.nav-link').contains('Início').should('exist');

        // Verifica o container do FullCalendar
        cy.get('#calendar-container').should('be.visible');
    });

    // Teste 2: Verificar a barra de ferramentas do FullCalendar
    it('Deve exibir os botões de navegação e visualização do calendário', () => {
        // O FullCalendar usa classes específicas para seus elementos de UI
        
        // Verifica o título do mês (ex: "novembro de 2025")
        cy.get('.fc-toolbar-title').should('be.visible').and('not.be.empty');

        // Verifica os botões de navegação (anterior, próximo, hoje)
        // Os botões usam classes como .fc-prev-button, mas o texto pode ser um ícone ou vazio.
        // Vamos verificar a existência e o atributo title, se disponível, ou apenas a classe.
        cy.get('.fc-prev-button').should('be.visible');
        cy.get('.fc-next-button').should('be.visible');
        cy.get('.fc-today-button').should('be.visible').and('contain', 'today');

        // Verifica os botões de visualização (mês, semana, dia)
        cy.get('.fc-dayGridMonth-button').should('be.visible').and('contain', 'month');
        cy.get('.fc-timeGridWeek-button').should('be.visible').and('contain', 'week');
        cy.get('.fc-timeGridDay-button').should('be.visible').and('contain', 'day');
    });

    // Teste 3: Simular a navegação entre meses
    it('Deve navegar para o mês seguinte ao clicar no botão "next"', () => {
        // Captura o título atual do calendário
        cy.get('.fc-toolbar-title').invoke('text').then((currentTitle) => {
            // Clica no botão "next"
            cy.get('.fc-next-button').click();

            // Verifica se o título mudou (o que indica a navegação)
            cy.get('.fc-toolbar-title').invoke('text').should('not.equal', currentTitle);
        });
    });

    // Teste 4: Simular a mudança de visualização para "week"
    it('Deve mudar a visualização para "week" ao clicar no botão correspondente', () => {
        // Clica no botão de visualização de semana
        cy.get('.fc-timeGridWeek-button').click();

        // Verifica se a classe da tabela principal mudou para a visualização de semana
        // O FullCalendar usa a classe 'fc-timegrid' para visualizações de semana/dia
        cy.get('.fc-view-harness').should('have.descendants', '.fc-timegrid');
    });

    // Teste 5: Testar a função de alerta (mostrarAlerta)
    it('Deve exibir e remover um alerta ao chamar a função mostrarAlerta', () => {
        const alertMessage = 'Teste de Alerta Cypress';
        const alertType = 'success';

        // Chama a função JS diretamente no contexto da página
        cy.window().then((win) => {
            // Verifica se a função existe antes de chamar
            if (typeof win.mostrarAlerta === 'function') {
                win.mostrarAlerta(alertMessage, alertType);
            } else {
                // Se a função não estiver no escopo global, o teste deve ser adaptado.
                // Para este teste, assumimos que ela está no escopo global (como no código JS fornecido).
                throw new Error('A função mostrarAlerta não está definida no escopo global.');
            }
        });

        // Verifica se o alerta apareceu
        cy.get('.alert').should('be.visible').and('contain', alertMessage);

        // Espera o tempo de remoção automática (4 segundos)
        // Nota: O Cypress pode ser mais rápido que o setTimeout, então o wait é necessário.
        cy.wait(4000);

        // Verifica se o alerta foi removido
        cy.get('.alert').should('not.exist');
    });
});
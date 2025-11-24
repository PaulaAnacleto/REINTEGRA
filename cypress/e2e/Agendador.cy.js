

describe('Página de Calendário/Eventos - Reintegra', () => {
    
    const CALENDAR_URL = 'http://localhost/Reintegra/view/Agendador.php'; 

    
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
       
        cy.get('.fc-toolbar-title').should('be.visible').and('not.be.empty');

     
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

        cy.get('.fc-toolbar-title').invoke('text').then((currentTitle) => {
            cy.get('.fc-next-button').click();
            cy.get('.fc-toolbar-title').invoke('text').should('not.equal', currentTitle);
        });
    });

    // Teste 4: Simular a mudança de visualização para "week"
    it('Deve mudar a visualização para "week" ao clicar no botão correspondente', () => {
        cy.get('.fc-timeGridWeek-button').click();
        cy.get('.fc-view-harness').should('have.descendants', '.fc-timegrid');
    });

    // Teste 5: Testar a função de alerta (mostrarAlerta)
    it('Deve exibir e remover um alerta ao chamar a função mostrarAlerta', () => {
        const alertMessage = 'Teste de Alerta Cypress';
        const alertType = 'success';

        cy.window().then((win) => {
            if (typeof win.mostrarAlerta === 'function') {
                win.mostrarAlerta(alertMessage, alertType);
            } else {

                throw new Error('A função mostrarAlerta não está definida no escopo global.');
            }
        });

        cy.get('.alert').should('be.visible').and('contain', alertMessage);

        cy.wait(4000);

        cy.get('.alert').should('not.exist');
    });
});
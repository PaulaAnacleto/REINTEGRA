// Aguarda o carregamento completo do DOM
document.addEventListener('DOMContentLoaded', function() {
    
    // Elementos da página
    const serviceCards = document.querySelectorAll('.service-card');
   // Funcionalidade do botão de voltar
    const backButton = document.querySelector('.back-button');
    
    if (backButton) {
        backButton.addEventListener('click', function() {
            // Verifica se há histórico de navegação
            if (window.history.length > 1) {
                window.history.back();
            } else {
                // Se não houver histórico, redireciona para a página inicial
                window.location.href = '../View/inicial-login.php';
            }
        });
    }
    
    

    // Função para mostrar loading no card
    function showCardLoading(card) {
        card.classList.add('loading');
        card.style.pointerEvents = 'none';
    }

    // Função para remover loading do card
    function hideCardLoading(card) {
        card.classList.remove('loading');
        card.style.pointerEvents = 'auto';
    }

  

        // Mostrar loading
        showCardLoading(card);
        
        // Simular tempo de carregamento
        setTimeout(() => {
            // Verificar se a página existe (simulação)
            // Em um sistema real, você faria uma verificação real
            const pageExists = Math.random() > 0.1; // 90% de chance de "existir"
            
            if (pageExists) {
                // Mostrar mensagem de redirecionamento
                console.log(`${route.description}`)};
                
              
    // Adicionar event listeners para cada card de serviço
    serviceCards.forEach(card => {
        const serviceKey = card.getAttribute('data-service');
        
        // Click handler
        card.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Verificar se o card não está em loading
            if (!this.classList.contains('loading')) {
                redirectToService(serviceKey, this);
            }
        });

        // Keyboard accessibility
        card.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                if (!this.classList.contains('loading')) {
                    redirectToService(serviceKey, this);
                }
            }
        });

        // Adicionar atributos de acessibilidade
        card.setAttribute('tabindex', '0');
        card.setAttribute('role', 'button');
        card.setAttribute('aria-label', `Acessar ${serviceRoutes[serviceKey]?.title || serviceKey}`);
    });

    // Funcionalidade do botão voltar
    if (backBtn) {
        backBtn.addEventListener('click', function() {
            // Verificar se há histórico para voltar
            if (window.history.length > 1) {
                window.history.back();
            } else {
                // Se não há histórico, redirecionar para página inicial
                window.location.href = 'index.html';
            }
        });

        // Acessibilidade para o botão voltar
        backBtn.setAttribute('aria-label', 'Voltar à página anterior');
    }

    // Efeitos visuais adicionais

    // Animação de entrada dos cards
    function animateCardsOnLoad() {
        serviceCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }

    // Executar animação após um pequeno delay
    setTimeout(animateCardsOnLoad, 200);

   

    // Função para destacar cards relacionados (exemplo de interatividade)
    function highlightRelatedServices(currentService) {
        const relatedServices = {
            'teste-vocacional': ['cursos', 'tutoriais'],
            'cursos': ['teste-vocacional', 'vagas'],
            'tutoriais': ['teste-vocacional', 'informativo'],
            'informativo': ['vagas', 'tutoriais'],
            'vagas': ['cursos', 'informativo']
        };

        const related = relatedServices[currentService] || [];
        
        serviceCards.forEach(card => {
            const serviceKey = card.getAttribute('data-service');
            if (related.includes(serviceKey)) {
                card.style.boxShadow = '0 8px 25px rgba(30, 115, 190, 0.2)';
                card.style.borderColor = 'rgba(30, 115, 190, 0.3)';
            }
        });
    }

    // Remover destaque dos cards relacionados
    function removeHighlight() {
        serviceCards.forEach(card => {
            card.style.boxShadow = '';
            card.style.borderColor = '';
        });
    }

    // Adicionar hover effects para destacar serviços relacionados
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            const serviceKey = this.getAttribute('data-service');
            highlightRelatedServices(serviceKey);
        });

        card.addEventListener('mouseleave', function() {
            removeHighlight();
        });
    });

    // Função para analytics (simulação)
    function trackServiceClick(serviceKey) {
        console.log(`Analytics: Usuário clicou no serviço "${serviceKey}" em ${new Date().toISOString()}`);
        
        // Em um sistema real, você enviaria dados para um serviço de analytics
        // analytics.track('service_click', { service: serviceKey, timestamp: Date.now() });
    }

    // Adicionar tracking aos clicks
    serviceCards.forEach(card => {
        card.addEventListener('click', function() {
            const serviceKey = this.getAttribute('data-service');
            trackServiceClick(serviceKey);
        });
    });

    // Função para mostrar tooltip com informações adicionais
    function createTooltip(card, text) {
        const tooltip = document.createElement('div');
        tooltip.className = 'service-tooltip';
        tooltip.textContent = text;
        tooltip.style.cssText = `
            position: absolute;
            background: #333;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            white-space: nowrap;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
        `;
        
        card.style.position = 'relative';
        card.appendChild(tooltip);
        
        setTimeout(() => {
            tooltip.style.opacity = '1';
        }, 100);
        
        return tooltip;
    }

    // Adicionar tooltips informativos (opcional)
    const tooltipTexts = {
        'teste-vocacional': 'Descubra sua vocação profissional',
        'cursos': 'Capacite-se com nossos cursos',
        'tutoriais': 'Aprenda dicas valiosas',
        'informativo': 'Mantenha-se atualizado',
        'vagas': 'Encontre sua próxima oportunidade'
    };

    serviceCards.forEach(card => {
        const serviceKey = card.getAttribute('data-service');
        let tooltip = null;
        
        card.addEventListener('mouseenter', function() {
            if (!tooltip && tooltipTexts[serviceKey]) {
                tooltip = createTooltip(this, tooltipTexts[serviceKey]);
            }
        });
        
        card.addEventListener('mouseleave', function() {
            if (tooltip) {
                tooltip.remove();
                tooltip = null;
            }
        });
    });

    // Inicialização completa
    console.log('Página de serviços REINTEGRA inicializada com sucesso!');
    console.log('Serviços disponíveis:', Object.keys(serviceRoutes));
});
});
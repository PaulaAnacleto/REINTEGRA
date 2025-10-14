// Funcionalidade do botão de voltar
document.addEventListener('DOMContentLoaded', function() {
    const backButton = document.querySelector('.back-button');
    
    if (backButton) {
        backButton.addEventListener('click', function() {
            // Verifica se há histórico de navegação
            if (window.history.length > 1) {
                window.history.back();
            } else {
                // Se não houver histórico, redireciona para a página de contato
                window.location.href = 'index.html';
            }
        });
    }

    // Adiciona animação suave ao rolar para seções
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    
    // Destaca seções ao rolar
    const sections = document.querySelectorAll('.content h2');
    
    const highlightSection = function() {
        const scrollPosition = window.scrollY + 150;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                section.style.transform = 'translateX(5px)';
                section.style.transition = 'transform 0.3s ease';
            } else {
                section.style.transform = 'translateX(0)';
            }
        });
    };

    window.addEventListener('scroll', highlightSection);

    

    // Adiciona tooltip aos links de contato
    const contactLinks = document.querySelectorAll('.contact-info a');
    
    contactLinks.forEach(link => {
        link.setAttribute('title', 'Clique para entrar em contato');
    });

    // Estilo para impressão
    const printStyles = document.createElement('style');
    printStyles.textContent = `
        @media print {
            .back-button,
            .footer-links,
            button {
                display: none !important;
            }
            
            .content {
                box-shadow: none;
                padding: 20px;
            }
            
            body {
                background-color: white;
            }
            
            .container {
                max-width: 100%;
            }
            
            a {
                color: #000;
                text-decoration: underline;
            }
            
            .highlight {
                color: #000;
            }
        }
    `;
    document.head.appendChild(printStyles);
});
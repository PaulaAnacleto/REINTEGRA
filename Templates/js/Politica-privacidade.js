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

    // Adiciona indicador de progresso de leitura
    const progressBar = document.createElement('div');
    progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(90deg, #1a73e8, #4285f4);
        z-index: 9999;
        transition: width 0.1s ease;
    `;
    document.body.appendChild(progressBar);

    window.addEventListener('scroll', function() {
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight - windowHeight;
        const scrolled = window.scrollY;
        const progress = (scrolled / documentHeight) * 100;
        
        progressBar.style.width = progress + '%';
    });

    // Adiciona botão "Voltar ao topo"
    const scrollToTopButton = document.createElement('button');
    scrollToTopButton.innerHTML = '↑';
    scrollToTopButton.setAttribute('aria-label', 'Voltar ao topo');
    scrollToTopButton.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #1a73e8;
        color: white;
        border: none;
        font-size: 24px;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.2s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    `;

    document.body.appendChild(scrollToTopButton);

    scrollToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    scrollToTopButton.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.1)';
    });

    scrollToTopButton.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });

    // Mostra/esconde o botão baseado na posição do scroll
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            scrollToTopButton.style.opacity = '1';
            scrollToTopButton.style.visibility = 'visible';
        } else {
            scrollToTopButton.style.opacity = '0';
            scrollToTopButton.style.visibility = 'hidden';
        }
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

    // Adiciona funcionalidade de impressão
    const printButton = document.createElement('button');
    printButton.innerHTML = '🖨️ Imprimir';
    printButton.style.cssText = `
        position: fixed;
        bottom: 90px;
        right: 30px;
        padding: 12px 20px;
        border-radius: 25px;
        background-color: white;
        color: #1a73e8;
        border: 2px solid #1a73e8;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.2s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    `;

    document.body.appendChild(printButton);

    printButton.addEventListener('click', function() {
        window.print();
    });

    printButton.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.05)';
        this.style.backgroundColor = '#1a73e8';
        this.style.color = 'white';
    });

    printButton.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
        this.style.backgroundColor = 'white';
        this.style.color = '#1a73e8';
    });

    // Mostra/esconde o botão de impressão baseado na posição do scroll
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            printButton.style.opacity = '1';
            printButton.style.visibility = 'visible';
        } else {
            printButton.style.opacity = '0';
            printButton.style.visibility = 'hidden';
        }
    });

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
// Funcionalidade do botão de voltar
document.addEventListener('DOMContentLoaded', function() {
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

    // Adiciona animação de entrada aos cards de contato
    const contactCards = document.querySelectorAll('.contact-card');
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '0';
                entry.target.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    entry.target.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, 100);
                
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    contactCards.forEach(card => {
        observer.observe(card);
    });

    // Adiciona feedback visual ao clicar nos links de contato
    const contactLinks = document.querySelectorAll('.contact-link');
    
    contactLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Cria efeito de ripple
            const ripple = document.createElement('span');
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255, 255, 255, 0.6)';
            ripple.style.width = '20px';
            ripple.style.height = '20px';
            ripple.style.pointerEvents = 'none';
            ripple.style.animation = 'ripple 0.6s ease-out';
            
            const rect = this.getBoundingClientRect();
            ripple.style.left = (e.clientX - rect.left - 10) + 'px';
            ripple.style.top = (e.clientY - rect.top - 10) + 'px';
            
            this.style.position = 'relative';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Adiciona estilo de animação ripple
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                width: 100px;
                height: 100px;
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    // Adiciona funcionalidade de copiar para área de transferência ao clicar com botão direito
    contactLinks.forEach(link => {
        link.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            
            const text = this.textContent.trim();
            
            // Copia para área de transferência
            navigator.clipboard.writeText(text).then(() => {
                // Mostra feedback visual
                const originalText = this.textContent;
                this.textContent = 'Copiado!';
                this.style.fontWeight = 'bold';
                
                setTimeout(() => {
                    this.textContent = originalText;
                    this.style.fontWeight = '500';
                }, 1500);
            }).catch(err => {
                console.error('Erro ao copiar:', err);
            });
        });
    });

    // Adiciona tooltip nos links
    contactLinks.forEach(link => {
        link.setAttribute('title', 'Clique para abrir ou clique com botão direito para copiar');
    });
});
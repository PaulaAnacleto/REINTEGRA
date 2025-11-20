// Funcionalidades interativas para a página de Segurança do Trabalho
document.addEventListener('DOMContentLoaded', function() {
    
    // Padrão do botão de voltar
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

    // Animação suave para o hero ao carregar a página
    const heroContent = document.querySelector('.hero-content');
    if (heroContent) {
        heroContent.style.opacity = '0';
        
        setTimeout(() => {
            heroContent.style.transition = 'opacity 0.8s ease';
            heroContent.style.opacity = '1';
        }, 100);
    }

    // Adiciona efeito de clique nos cards de conhecimento
    const knowledgeCards = document.querySelectorAll('.knowledge-card');
    
    knowledgeCards.forEach(card => {
        // Adiciona cursor pointer ao card
        card.style.cursor = 'pointer';

        // Efeito de clique
        card.addEventListener('click', function(e) {
            // Se o clique não foi no link, simula o clique no link
            if (e.target.tagName !== 'A') {
                const link = this.querySelector('.card-link');
                if (link) {
                    e.preventDefault();
                    // Adiciona efeito visual de clique
                    this.style.transition = 'transform 0.1s ease';
                    this.style.transform = 'scale(0.98)';
                    
                    setTimeout(() => {
                        this.style.transform = 'translateY(-8px) scale(1)';
                    }, 100);

                    // Aqui você pode adicionar navegação ou modal com mais informações
                    const cardTitle = this.querySelector('h4').textContent;
                    console.log('Card clicado:', cardTitle);
                }
            }
        });

        // Efeito de hover aprimorado
        card.addEventListener('mouseenter', function() {
            const icon = this.querySelector('.card-icon');
            if (icon) {
                icon.style.transition = 'transform 0.3s ease';
                icon.style.transform = 'scale(1.1) rotate(5deg)';
            }
        });

        card.addEventListener('mouseleave', function() {
            const icon = this.querySelector('.card-icon');
            if (icon) {
                icon.style.transform = 'scale(1) rotate(0deg)';
            }
        });
    });

    // Efeito de hover nos links de navegação
    const navLinks = document.querySelectorAll('.main-nav a');
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            if (!this.classList.contains('active')) {
                this.style.transition = 'transform 0.3s ease';
                this.style.transform = 'translateY(-2px)';
            }
        });

        link.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Efeito de hover no ícone de usuário
    const userIcon = document.querySelector('.user-icon');
    if (userIcon) {
        userIcon.addEventListener('click', function() {
            // Simula um menu de usuário
            alert('Funcionalidade de perfil de usuário');
        });

        userIcon.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
        });

        userIcon.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    }

    // Adiciona efeito de parallax suave ao scroll
    let ticking = false;
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                const scrolled = window.pageYOffset;
                const header = document.querySelector('.main-header');
                
                if (header && scrolled > 50) {
                    header.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
                    header.style.transition = 'box-shadow 0.3s ease';
                } else if (header) {
                    header.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.1)';
                }
                
                ticking = false;
            });
            
            ticking = true;
        }
    });

    // Adiciona efeito de ripple nos cards ao clicar
    knowledgeCards.forEach(card => {
        card.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');

            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Adiciona efeito de hover nos links do footer
    const footerLinks = document.querySelectorAll('.footer-link');
    footerLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.transition = 'all 0.3s ease';
        });

        link.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Intersection Observer para animações ao scroll
    if ('IntersectionObserver' in window) {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observa as seções
        const sections = document.querySelectorAll('.knowledge-section, .partnership-section');
        sections.forEach(section => {
            observer.observe(section);
        });
    }

    // Adiciona efeito nos links "Saiba mais"
    const cardLinks = document.querySelectorAll('.card-link');
    cardLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Efeito visual de clique
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);

            // Aqui você pode adicionar a lógica real de navegação
            const cardTitle = this.closest('.knowledge-card').querySelector('h4').textContent;
            console.log('Saiba mais sobre:', cardTitle);
        });
    });

    // Adiciona efeito de hover no logo SENAI
    const partnershipLogo = document.querySelector('.partnership-logo img');
    if (partnershipLogo) {
        partnershipLogo.addEventListener('mouseenter', function() {
            this.style.transition = 'transform 0.3s ease';
            this.style.transform = 'scale(1.05)';
        });

        partnershipLogo.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    }

    // Adiciona animação suave ao hero icon
    const heroIcon = document.querySelector('.hero-icon img');
    if (heroIcon) {
        heroIcon.style.opacity = '0';
        heroIcon.style.transform = 'translateX(30px)';
        
        setTimeout(() => {
            heroIcon.style.transition = 'all 0.8s ease';
            heroIcon.style.opacity = '1';
            heroIcon.style.transform = 'translateX(0)';
        }, 300);
    }

    // Adiciona efeito de hover nos ícones dos cards
    const cardIcons = document.querySelectorAll('.card-icon');
    cardIcons.forEach(icon => {
        icon.addEventListener('mouseenter', function() {
            const img = this.querySelector('img');
            if (img) {
                img.style.transition = 'transform 0.3s ease';
                img.style.transform = 'scale(1.2)';
            }
        });

        icon.addEventListener('mouseleave', function() {
            const img = this.querySelector('img');
            if (img) {
                img.style.transform = 'scale(1)';
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    // Adiciona animações ao carregar a página
    const colaboradorCards = document.querySelectorAll('.colaborador-card');
    
    colaboradorCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });

    // Adiciona efeito de ripple ao clicar nos botões
    const buttons = document.querySelectorAll('.btn-colaborador');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
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

    // Adiciona feedback visual ao passar o mouse nos cards
    colaboradorCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
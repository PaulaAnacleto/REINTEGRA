// Rolagem suave para links de navegação (ex: menu ou âncoras internas)
document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const destino = document.querySelector(this.getAttribute('href'));
        if (destino) {
            destino.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});



// Função para exibir alertas na tela
function mostrarAlerta(mensagem, tipo) {
    // Cria o elemento de alerta
    const alertaDiv = document.createElement('div');
    alertaDiv.className = `alert alert-${tipo} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
    alertaDiv.style.zIndex = '9999';
    alertaDiv.style.minWidth = '300px';
    alertaDiv.innerHTML = `
        ${mensagem}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alertaDiv);
    
    // Remove automaticamente após 4 segundos
    setTimeout(() => {
        alertaDiv.remove();
    }, 4000);
}

// Efeito na barra de navegação ao rolar a página
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('shadow');
    } else {
        navbar.classList.remove('shadow');
    }
});

// Animação de aparecimento (fade-in) ao rolar a página
const opcoesObservador = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observador = new IntersectionObserver(function(entradas) {
    entradas.forEach(entrada => {
        if (entrada.isIntersecting) {
            entrada.target.classList.add('fade-in');
            observador.unobserve(entrada.target);
        }
    });
}, opcoesObservador);

// Observa as seções para aplicar o efeito de fade-in
document.querySelectorAll('section').forEach(secao => {
    observador.observe(secao);
});
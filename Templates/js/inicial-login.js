// // Aguarda o DOM carregar antes de executar qualquer script
document.addEventListener('DOMContentLoaded', function() {

    // ===================================================================
    // FUNÇÃO DE ALERTA (DO SEU CÓDIGO)
    // ===================================================================
    // (Movida para o topo para que possa ser usada por outros scripts)
    function mostrarAlerta(mensagem, tipo) {
      const alertaDiv = document.createElement('div');
      alertaDiv.className = `alert alert-${tipo} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
      alertaDiv.style.zIndex = '9999';
      alertaDiv.style.minWidth = '300px';
      alertaDiv.innerHTML = `
        ${mensagem}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      `;
      document.body.appendChild(alertaDiv);
      
      setTimeout(() => {
        alertaDiv.remove();
      }, 4000);
    }

    // ===================================================================
    // MANIPULADOR DE FEEDBACK (CÓDIGO MESCLADO)
    // ===================================================================
    
    // 1. Selecionamos o FORMULÁRIO (que tem o ID 'feedbackForm' do nosso HTML)
    const feedbackForm = document.getElementById('feedbackForm');
    
    if (feedbackForm) {
        const input = feedbackForm.querySelector('.feedback-input');
        const button = feedbackForm.querySelector('.btn-feedback-submit');

        // 2. Ouvimos o evento 'submit' do formulário (é melhor que 'click' no botão)
        feedbackForm.addEventListener('submit', async function(e) {
            // Previne o recarregamento da página
            e.preventDefault(); 

            const textoFeedback = input.value.trim();
            
            // 3. Validação (usando sua função de alerta)
            if (textoFeedback === '') {
          mostrarAlerta('Por favor, digite seu feedback.', 'warning');
          return;
        }

            // 4. Prepara o 'fetch'
            const formData = new FormData(feedbackForm);
            button.disabled = true; // Desabilita o botão

            // 5. Envia para o FeedbackController (PHP)
            try {
                const response = await fetch('../Controller/FeedbackController.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                // 6. Mostra a MENSAGEM REAL vinda do PHP usando sua função de alerta
                if (result.success) {
                    mostrarAlerta(result.message, 'success'); // Ex: "Feedback enviado!"
                    input.value = ''; // Limpa o campo
                } else {
                    mostrarAlerta(result.message, 'warning'); // Ex: "Você precisa estar logado"
                }

            } catch (error) {
                console.error('Erro na requisição:', error);
                mostrarAlerta('Não foi possível conectar ao servidor.', 'danger');
            } finally {
                // 7. Reabilita o botão
                button.disabled = false; 
            }
        });

        // 8. Permitir envio com Enter (do seu código)
        input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
                e.preventDefault(); // Previne o 'Enter' de pular linha
          // Dispara o evento de 'submit' do formulário
                feedbackForm.dispatchEvent(new Event('submit', { cancelable: true }));
        }
      });
    }

    // ===================================================================
    // SEUS OUTROS SCRIPTS (SCROLL, FADE-IN, ETC)
    // ===================================================================

    // Rolagem suave para links de navegação
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

    // Efeito na barra de navegação ao rolar a página
    window.addEventListener('scroll', function() {
      const navbar = document.querySelector('.navbar');
      if (navbar) { // Boa prática: verificar se o elemento existe
        if (window.scrollY > 50) {
          navbar.classList.add('shadow');
        } else {
          navbar.classList.remove('shadow');
        }
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

    // Adiciona atraso de animação nos cartões de feedback (efeito em cascata)
    document.querySelectorAll('.feedback-card').forEach((cartao, indice) => {
      cartao.style.animationDelay = `${indice * 0.2}s`;
    });

}); // Fim do 'DOMContentLoaded'
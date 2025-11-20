// Aguarda o carregamento completo do DOM
document.addEventListener('DOMContentLoaded', function() {
  
  // Elementos do formulário
  const form = document.getElementById('loginForm');
  const email = document.getElementById('email');
  const senha = document.getElementById('senha');
  const submitBtn = document.querySelector('.submit-btn');
  const learnMoreBtn = document.querySelector('.learn-more-btn');
  const forgotLink = document.querySelector('.forgot-link');

  // Função para validar email
  function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  // Função para validar senha (mínimo 6 caracteres para login)
  function validateSenha(senha) {
    // ATENÇÃO: Seu cadastro pede 8+ chars e regras. O login só pede 6.
    // Isso pode ser confuso. Mudei para 8 para bater com o cadastro.
    return senha.length >= 8; 
  }

  // Função para mostrar erro no campo
  function showError(input, message) {
    const wrapper = input.parentElement;
    const inputGroup = wrapper.parentElement;
    const errorContainer = inputGroup.querySelector('.error-message');
    
    wrapper.classList.add('error');
    wrapper.classList.remove('success');
    
    if (errorContainer) {
      errorContainer.textContent = message;
      errorContainer.style.display = 'block';
    }
  }

  // Função para mostrar sucesso no campo
  function showSuccess(input) {
    const wrapper = input.parentElement;
    const inputGroup = wrapper.parentElement;
    const errorContainer = inputGroup.querySelector('.error-message');
    
    wrapper.classList.remove('error');
    wrapper.classList.add('success');
    
    if (errorContainer) {
      errorContainer.textContent = '';
      errorContainer.style.display = 'none';
    }
  }

  // Validação em tempo real para email
  email.addEventListener('blur', function() {
    const emailValue = this.value.trim();
    
    if (!emailValue) {
      showError(this, 'Email é obrigatório');
    } else if (!validateEmail(emailValue)) {
      showError(this, 'Digite um email válido');
    } else {
      showSuccess(this);
    }
  });

  // Validação em tempo real para senha
  senha.addEventListener('blur', function() {
    const senhaValue = this.value;
    
    if (!senhaValue) {
      showError(this, 'Senha é obrigatória');
    } else if (!validateSenha(senhaValue)) {
      // Mudei a mensagem para refletir os 8 caracteres
      showError(this, 'Senha deve ter pelo menos 8 caracteres');
    } else {
      showSuccess(this);
    }
  });

  // Função para validar todo o formulário
  function validateForm() {
    let isValid = true;
    
    // Validar email
    if (!email.value.trim()) {
      showError(email, 'Email é obrigatório');
      isValid = false;
    } else if (!validateEmail(email.value.trim())) {
      showError(email, 'Digite um email válido');
      isValid = false;
    } else {
            showSuccess(email); // Adicionado
        }

    // Validar senha
    if (!senha.value) {
      showError(senha, 'Senha é obrigatória');
      isValid = false;
    } else if (!validateSenha(senha.value)) {
      showError(senha, 'Senha deve ter pelo menos 8 caracteres');
      isValid = false;
    } else {
            showSuccess(senha); // Adicionado
        }

    return isValid;
  }

 
  // --- INÍCIO DA PARTE MESCLADA: Manipulador do envio do formulário ---
  form.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // 1. Valida o formulário
    if (!validateForm()) {
      console.log('Formulário de login inválido');
      return;
    }

    // 2. Mostra o loading
    submitBtn.disabled = true;
    submitBtn.style.transform = 'translateY(0) scale(1)';
    submitBtn.textContent = 'Entrando...';

    // 3. Prepara os dados
    const formData = new FormData(form);
    formData.append('action', 'login'); // Diz ao UserController o que fazer

    // 4. Envia para o backend (PHP)
    try {
      const response = await fetch('../Controller/UserController.php', {
        method: 'POST',
        body: formData
      });

      const result = await response.json();

      if (result.success) {
        alert(result.message);
        // Redireciona para a página principal
        window.location.href = '../View/Inicial-login.php'; 
      } else {
        // Mostra erro (ex: "Email ou senha inválidos")
        alert('Erro no login: ' + result.message);
      }

    } catch (error) {
      console.error('Erro na requisição:', error);
      alert('Não foi possível conectar ao servidor.');
    } finally {
      // 5. Reabilita o botão
      submitBtn.disabled = false;
      submitBtn.textContent = 'Entrar';
    }
  });
    // --- FIM DA PARTE MESCLADA ---

  // Funcionalidade do link "Esqueceu a senha?"
  forgotLink.addEventListener('click', function(e) {
    e.preventDefault();
    
    const userEmail = prompt('Digite seu email para recuperar a senha:');
    
    if (userEmail && validateEmail(userEmail)) {
      alert(`Um link de recuperação (ainda não funcional) foi enviado para ${userEmail}`);
      console.log('Solicitação de recuperação de senha para:', userEmail);
    } else if (userEmail) {
      alert('Por favor, digite um email válido.');
    }
  });

  // [Seu código de Efeitos visuais adicionais (focus, typeWriter, etc) ...]
    // ... (todo o seu código de 'focus', 'typeWriter', 'mousemove', 'mouseenter' permanece igual) ...

  // Funcionalidade de "Enter" para submeter o formulário
  const inputs = document.querySelectorAll('input');
  inputs.forEach(input => {
    input.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault(); // Previne envio duplo
        form.dispatchEvent(new Event('submit', { cancelable: true }));
      }
    });
  });

 
});
// (Removi o '});' extra que estava no final do seu código original)
